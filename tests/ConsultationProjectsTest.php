<?php
use App\Writeups\ConsultationProject;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/7/16
 * Time: 6:34 PM
 */
class ConsultationProjectsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_new_talk_can_be_created_without_being_saved_to_the_db()
    {
        $project = new ConsultationProject([
            'title' => 'Save the Whale',
            'content' => 'I love those blubbery bastards',
            'link' => 'http://savethewhales.com'
        ]);

        $this->assertEquals('Save the Whale', $project->title);
        $this->assertEquals('I love those blubbery bastards', $project->content);
        $this->assertEquals('http://savethewhales.com', $project->link);

        $this->notSeeInDatabase('writeups', [
            'title' => 'Save the Whale',
            'category' => 'consultation',
            'content' => 'I love those bubbery bastards',
            'link' => 'http://savethewhales.com'
        ]);
    }

    /**
     * @test
     */
    public function a_new_conversation_project_can_be_created_and_writen_to_the_db()
    {
        $project = ConsultationProject::create([
            'title' => 'Save the Whale',
            'content' => 'I love those blubbery bastards',
            'link' => 'http://savethewhales.com'
        ]);

        $this->seeInDatabase('writeups', [
            'id' => $project->id,
            'title' => 'Save the Whale',
            'category' => 'consultation',
            'content' => 'I love those blubbery bastards',
            'link' => 'http://savethewhales.com'
        ]);
    }

}