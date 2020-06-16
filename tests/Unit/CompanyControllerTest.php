<?php

namespace Tests\Unit;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Company;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;



class CompanyControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;


    public function test_index_method()
    {

        $user = factory(User::class)->create();


        factory(Company::class)->create(['name' => 'first_company']);
        factory(Company::class)->create(['name' => 'second_company']);

        $response =  $this->actingAs($user)->get(route('company.index'));
        $response->assertStatus(200);
        $response->assertSee('first_company');
        $response->assertSee('second_company');

    }


    public function test_show_company_detail(){

        $company = factory(Company::class)->create(['name' => 'first_company']);
        $user = factory(User::class)->create();
        $response =  $this->actingAs($user)->get(route('company.show',['id' => $company->id]));
        $response->assertStatus(200);
        $response->assertSee('first_company');

    }

    public function test_delete_company(){

        $user = factory(User::class)->create();
        $company = factory(Company::class)->create(['name' => 'first_company']);

        $response =  $this->actingAs($user)->followingRedirects()->delete(route('company.destroy',$company->id));
        $response->assertStatus(200);
        $response->assertSee('Company has been successfuly deleted');

    }

    public function test_edit_company(){

        $user = factory(User::class)->create();

        $company = factory(Company::class)->create(['name' => 'first_company','email' => 'test@gmail.com']);

        $response =  $this->actingAs($user)->followingRedirects()->put(route('company.update',$company->id),['name' => 'changedName','email'=> 'test2@gmail.com','logo' => $logo = UploadedFile::fake()->image('test_slika.png', 101, 101)]);
        $response->assertStatus(200);
        $response->assertSee('Company has been successfuly updated');
        $response->assertSee('changedName');
        $response->assertSee('test2@gmail.com');
        $response->assertDontSee('noimage.png');


    }

    public function test_create_company(){

        $user = factory(User::class)->create();

        $data_cases = [
            ['name' => 'test1','email' => 'test1@gmail.com','logo' => $logo = UploadedFile::fake()->image('test_slika.png', 101, 101),'website' => 'testwebsite1'],
            ['name' => 'test2','email' => 'test2@gmail.com','website' => 'testwebsite2'],
            ['name' => 'test3','website' => 'testwebsite3'],
            ['name' => 'test4','email' => 'test4@gmail.com']
        ];

        $response1 =  $this->actingAs($user)->followingRedirects()->post(route('company.store'),$data_cases[0]);

        $response1->assertStatus(200);
        $response1->assertSee('Company has been successfuly created');
        $response1->assertSee('test1');
        $response1->assertSee('test1@gmail.com');
        $response1->assertSee('testwebsite');
        $response1->assertDontSee('noimage.png');

        $response2 =  $this->actingAs($user)->followingRedirects()->post(route('company.store'),$data_cases[1]);
        $response2->assertSee('Company has been successfuly created');
        $response2->assertStatus(200);
        $response2->assertSee('test2');
        $response2->assertSee('test2@gmail.com');
        $response2->assertSee('testwebsite');
        $response2->assertSee('noimage.png');

        $response3 =  $this->actingAs($user)->followingRedirects()->post(route('company.store'),$data_cases[2]);
        $response4 =  $this->actingAs($user)->followingRedirects()->post(route('company.store'),$data_cases[3]);


        $response3->assertStatus(200);
        $response3->assertSee('Company has been successfuly created');

        $response3->assertSee('test3');
        $response3->assertSee('testwebsite3');

        $response4->assertStatus(200);
        $response4->assertSee('Company has been successfuly created');

        $response4->assertSee('test4');
        $response4->assertSee('test4@gmail.com');


    }

}
