<?php
use App\Affiliate;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/16/16
 * Time: 8:25 AM
 */
class AffiliatesTest extends TestCase
{

    use DatabaseMigrations, TestsImageUploads;

    /**
     * @test
     */
    public function an_affiliate_can_be_created()
    {
        $affiliate = factory(Affiliate::class)->create();

        $this->assertInstanceOf(Affiliate::class, $affiliate);
    }

    /**
     * @test
     */
    public function an_affiliate_can_be_created_by_posting_to_regular_endpoint()
    {
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $this->call('POST', '/admin/affiliates', [
            'name'        => 'testy mactestyface',
            'description' => 'a test',
            'website'     => 'http://testy.org'
        ]);

        $this->seeInDatabase('affiliates', [
            'name'        => 'testy mactestyface',
            'description' => 'a test',
            'website'     => 'http://testy.org'
        ]);
    }

    /**
     * @test
     */
    public function an_affiliates_info_can_be_updated()
    {
        $affiliate = factory(Affiliate::class)->create();
        $this->asLoggedInUser();

        $this->visit('/admin/affiliates/' . $affiliate->id . '/edit')
            ->type('Updated affiliate', 'name')
            ->type('altered states', 'description')
            ->type('http://newlink.org', 'website')
            ->press('Save Changes')
            ->seeInDatabase('affiliates', [
                'id'          => $affiliate->id,
                'name'        => 'Updated affiliate',
                'description' => 'altered states',
                'website'     => 'http://newlink.org'
            ]);
    }

    /**
     *@test
     */
    public function an_affiliate_can_be_deleted()
    {
        $affiliate = factory(Affiliate::class)->create();
        $this->asLoggedInUser();

        $response = $this->call('DELETE', '/admin/affiliates/'.$affiliate->id);
        $this->assertEquals(302, $response->status());

        $this->notSeeInDatabase('affiliates', ['id' => $affiliate->id]);
    }

    /**
     *@test
     */
    public function an_image_can_be_uploaded_and_associated_with_an_affiliate()
    {
        $affiliate = factory(Affiliate::class)->create();
        $this->asLoggedInUser();
        $this->assertCount(0, $affiliate->getMedia());

        $this->withoutMiddleware();

        $response = $this->call('POST', '/admin/affiliates/'.$affiliate->id.'/image', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(1, $affiliate->getMedia());

        $affiliate->clearMediaCollection();

    }

}