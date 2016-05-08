<?php
use App\Writeups\ConsultationProject;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/7/16
 * Time: 11:52 PM
 */
class ConsultationProjectsApplicationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_conservation_project_writeup_can_be_created()
    {
        $this->asLoggedInUser();

        $this->visit('/admin/consulting/create')
            ->submitForm('Create', [
                'title'   => 'Save the whale',
                'content' => 'I love those blubbery bastards',
                'link'    => 'http://savethewhale.com'
            ])->seeInDatabase('writeups', [
                'title'    => 'Save the whale',
                'category' => 'consultation',
                'content'  => 'I love those blubbery bastards',
                'link'     => 'http://savethewhale.com'
            ]);
    }

    /**
     * @test
     */
    public function a_conservation_project_can_be_edited()
    {
        $project = ConsultationProject::create([
            'title'   => 'Save the whale',
            'content' => 'I love those blubbery bastards',
            'link'    => 'http://savethewhale.com'
        ]);

        $this->asLoggedInUser();

        $this->visit('/admin/consulting/' . $project->id . '/edit')
            ->type('Kill the whales', 'title')
            ->type('They do nothing for me', 'content')
            ->type('http://killthewhales.com', 'link')
            ->press('Save Changes')
            ->seeInDatabase('writeups', [
                'id'       => $project->id,
                'title'    => 'Kill the whales',
                'category' => 'consultation',
                'content'  => 'They do nothing for me',
                'link'     => 'http://killthewhales.com'
            ]);
    }

    /**
     * @test
     */
    public function a_conservation_project_can_be_deleted()
    {
        $project = ConsultationProject::create([
            'title'   => 'Save the whale',
            'content' => 'I love those blubbery bastards',
            'link'    => 'http://savethewhale.com'
        ]);

        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $response = $this->call('DELETE', '/admin/conservation/' . $project->id);
        $this->assertEquals(302, $response->status());

        $this->notSeeInDatabase('writeups', ['id' => $project->id]);
    }
}