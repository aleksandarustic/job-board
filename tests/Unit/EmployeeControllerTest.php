<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use App\Employee;
use App\Company;


class EmployeeControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;


    public function test_index_method()
    {

        $user = factory(User::class)->create();

        factory(Company::class,3)->create();

        factory(Employee::class)->create(['firstname' => 'first_employee']);
        factory(Employee::class)->create(['firstname' => 'second_employee']);

        $response =  $this->actingAs($user)->get(route('employee.index'));
        $response->assertStatus(200);
        $response->assertSee('first_employee');
        $response->assertSee('second_employee');

    }


    public function test_show_employee_detail(){

        $company = factory(Company::class)->create();

        $employee = factory(Employee::class)->create(['firstname' => 'first_employee','company' => $company->id]);
        $user = factory(User::class)->create();
        $response =  $this->actingAs($user)->get(route('employee.show',['id' => $employee->id]));
        $response->assertStatus(200);
        $response->assertSee('first_employee');

    }

    public function test_delete_employee(){

        $user = factory(User::class)->create();
        $company = factory(Company::class)->create();
        $employee = factory(Employee::class)->create(['firstname' => 'first_employee','company' => $company->id]);

        $response =  $this->actingAs($user)->followingRedirects()->delete(route('employee.destroy',$employee->id));
        $response->assertStatus(200);
        $response->assertSee('Employee has been successfuly deleted');

    }

    public function test_edit_employee(){

        $user = factory(User::class)->create();

        $company1 = factory(Company::class)->create(['name' => 'first_company']);
        $company2 = factory(Company::class)->create(['name' => 'second_company']);


        $employee = factory(Employee::class)->create(['firstname' => 'first_employee','lastname' =>'first_employee', 'email' => 'test@gmail.com','company' => $company1->id]);

        $response =  $this->actingAs($user)->followingRedirects()->put(route('employee.update',$employee->id),['firstname' => 'changedName','lastname' => 'changedName','email'=> 'test2@gmail.com','company' => $company2->id]);
        $response->assertStatus(200);
        $response->assertSee('Employee has been successfuly updated');
        $response->assertSee('changedName');
        $response->assertSee($company2->name);
        $response->assertSee('test2@gmail.com');


    }

    public function test_create_employee(){

        $user = factory(User::class)->create();

        $companie1 = factory(Company::class)->create();
        $companie2 = factory(Company::class)->create();
        $companie3 = factory(Company::class)->create();
        $companie4 = factory(Company::class)->create();

        $data_cases = [
            ['firstname' => 'test1','lastname' => 'test1','email' => 'test1@gmail.com','phone' => '06555','company' => $companie1->id],
            ['firstname' => 'test2','lastname' => 'test2','email' => 'test2@gmail.com','company' => $companie2->id],
            ['firstname' => 'test3','lastname' => 'test3','phone' => '06666','company' => $companie3->id],
            ['firstname' => 'test4','lastname' => 'test4','company' => $companie4->id]
        ];

        $response1 =  $this->actingAs($user)->followingRedirects()->post(route('employee.store'),$data_cases[0]);

        $response1->assertStatus(200);
        $response1->assertSee('Employee has been successfuly created');
        $response1->assertSee('test1');
        $response1->assertSee('test1@gmail.com');
        $response1->assertSee('06555');

        $response2 =  $this->actingAs($user)->followingRedirects()->post(route('employee.store'),$data_cases[1]);
        $response2->assertSee('Employee has been successfuly created');
        $response2->assertStatus(200);
        $response2->assertSee('test2');
        $response2->assertSee('test2@gmail.com');

        $response3 =  $this->actingAs($user)->followingRedirects()->post(route('employee.store'),$data_cases[2]);

        $response3->assertStatus(200);
        $response3->assertSee('Employee has been successfuly created');
        $response3->assertSee('test3');
        $response3->assertSee('06666');

        $response4 =  $this->actingAs($user)->followingRedirects()->post(route('employee.store'),$data_cases[3]);

        $response4->assertStatus(200);
        $response4->assertSee('Employee has been successfuly created');

        $response4->assertSee('test4');


    }
}
