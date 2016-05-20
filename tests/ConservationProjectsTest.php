<?php
use App\Writeups\ConservationProject;
use App\Writeups\ConsultationProject;
use App\Writeups\Talk;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/7/16
 * Time: 5:35 PM
 */
class ConservationProjectsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_new_conservation_project_can_be_created_without_being_saved_to_the_db()
    {
        $project = new ConservationProject([
            'title' => 'Save the Whale',
            'content' => 'I love those blubbery bastards',
            'link' => 'http://savethewhales.com'
        ]);

        $this->assertEquals('Save the Whale', $project->title);
        $this->assertEquals('I love those blubbery bastards', $project->content);
        $this->assertEquals('http://savethewhales.com', $project->link);

        $this->notSeeInDatabase('writeups', [
            'title' => 'Save the Whale',
            'category' => 'conservation',
            'content' => 'I love those bubbery bastards',
            'link' => 'http://savethewhales.com'
        ]);
    }

    /**
     * @test
     */
    public function a_new_conversation_project_can_be_created_and_writen_to_the_db()
    {
        $project = ConservationProject::create([
            'title' => 'Save the Whale',
            'content' => 'I love those blubbery bastards',
            'link' => 'http://savethewhales.com'
        ]);

        $this->seeInDatabase('writeups', [
            'id' => $project->id,
            'title' => 'Save the Whale',
            'category' => 'conservation',
            'content' => 'I love those blubbery bastards',
            'link' => 'http://savethewhales.com'
        ]);
    }

    /**
     * @test
     */
    public function a_conservation_project_can_be_fetched_by_id()
    {
        $project = ConservationProject::create([
            'title' => 'Save the Whale',
            'content' => 'I love those blubbery bastards',
            'link' => 'http://savethewhales.com'
        ]);

        $fetched = ConservationProject::findOrFail($project->id);
        $this->assertEquals($project->id, $fetched->id);
        $this->assertEquals($project->title, $fetched->title);
        $this->assertEquals($project->description, $fetched->description);
        $this->assertEquals($project->category, $fetched->category);

    }

    /**
     *@test
     */
    public function conversation_projects_can_be_queried()
    {
        $attributes = [
            'title' => 'Save the Whale',
            'content' => 'I love those blubbery bastards',
            'link' => 'http://savethewhales.com'
        ];
        ConservationProject::create($attributes);
        ConservationProject::create($attributes);
        Talk::create($attributes);
        ConsultationProject::create($attributes);

        $fetched = ConservationProject::all();
        $this->assertCount(2, $fetched);

        $fetched->each(function($project) {
            $this->assertEquals('conservation', $project->category);
        });
    }


}