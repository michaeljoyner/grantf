<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/8/16
 * Time: 3:52 PM
 */
class WriteupImagesTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_image_can_be_uploaded_and_associated_with_a_writeup()
    {
        $writeup = \App\Writeups\Talk::create([
            'title'   => 'Save the whale',
            'content' => 'I love those blubbery bastards',
            'link'    => 'http://savethewhale.com'
        ]);

        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $response = $this->call('POST', '/admin/writeups/'.$writeup->id.'/image', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(1, $writeup->getMedia());

        $writeup->clearMediaCollection();

    }

    /**
     *@test
     */
    public function a_writeup_always_has_an_image_url()
    {
        $writeup = \App\Writeups\Talk::create([
            'title'   => 'Save the whale',
            'content' => 'I love those blubbery bastards',
            'link'    => 'http://savethewhale.com'
        ]);

        $this->assertNotNull($writeup->getImageSrc());
        $this->assertNotEquals("", $writeup->getImageSrc());
    }

}