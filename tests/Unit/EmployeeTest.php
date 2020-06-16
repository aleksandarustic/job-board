<?php

namespace Tests\Unit;

use App\Employee;
use App\Company;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


class EmployeeTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testEmployeeCanBeDeleted()
    {
        $company = factory(Company::class)->create();
        $employee = factory(Employee::class)->create(['firstname' => 'test', 'lastname' => 'test',  'email' => 'test@gmail.com','company' =>$company->id]);
        $employee->delete();

        $this->assertDatabaseMissing('employees',['firstname' => 'test','lastname' => 'test','email' => 'test@gmail.com']);

    }

    public function testEmployeeCanBeCreated()
    {
        $company = factory(Company::class)->create();
        $employee = factory(Employee::class)->create(['firstname' => 'test', 'lastname' => 'test',  'email' => 'test@gmail.com','company' => $company->id]);
        $latest_employee = $employee->latest()->first();
        $this->assertEquals($employee->id, $latest_employee->id);
        $this->assertEquals('test', $latest_employee->firstname);
        $this->assertEquals('test', $latest_employee->lastname);
        $this->assertEquals('test@gmail.com', $latest_employee->email);
        $this->assertDatabaseHas('employees', ['id' => $employee->id, 'firstname' => 'test', 'lastname' => 'test', 'email' => 'test@gmail.com']);
    }

    public function testEmployeeCanBeEdited(){

        $company1 = factory(Company::class)->create();
        $company2 = factory(Company::class)->create();

        $employee = factory(Employee::class)->create(['firstname' => 'test', 'lastname' => 'test',  'email' => 'test@gmail.com','company' => $company1->id]);
        $this->assertDatabaseHas('employees', ['id' => $employee->id, 'firstname' => 'test', 'lastname' => 'test', 'email' => 'test@gmail.com']);

        $employee->firstname = 'newname';
        $employee->lastname = 'newname';
        $employee->email = 'new@gmail.com';
        $employee->company = $company2->id;
        $employee->save();

        $this->assertDatabaseHas('employees', ['id' => $employee->id, 'company' => $company2->id, 'firstname' => 'newname','lastname' => 'newname', 'email' => 'new@gmail.com']);

    }
}
