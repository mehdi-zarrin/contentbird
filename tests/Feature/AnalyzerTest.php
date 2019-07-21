<?php


namespace Tests\Feature;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AnalyzerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_could_translate_url_to_array_of_data()
    {
        $url = 'http://contentbird.io';
        $response = $this->makePage($url);
        $this->assertStructure($response);
        $this->assertDatabaseHas('pages', ['url' => $url]);
    }

    /**
     * @test
     */
    public function when_url_is_not_valid_it_should_return_validation_errors()
    {
        $this->makePage('xxx')
             ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
             ->assertJsonValidationErrors(['url']);
    }

    /**
     * @test
     */
    public function it_should_throw_exception_when_url_format_correct_but_url_is_unreachable()
    {
        $this->makePage('http://asdasasdasdas.com')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => Lang::get('api.invalid_url')
            ]);
    }
    

    /**
     * @test
     */
    public function show_endpoint_show_return_json()
    {
        $data = $this->makePage()->json('data');

        $response = $this->getJson('/api/pages/'. $data['id'])
             ->assertStatus(200);

        $this->assertStructure($response);
    }

    private function assertStructure(TestResponse $response) {

        $response->assertJsonStructure([
            'data' => [
                'id',
                'result' => [
                    'title',
                    'internalLinks',
                    'externalLinks',
                    'images'
                ],
                'url'
            ]
        ]);
    }

    private function makePage($url = 'http://google.com')
    {
        return $this->postJson('/api/pages', [
            'url' => $url
        ]);
    }


    
}