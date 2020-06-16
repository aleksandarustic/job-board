<?php

namespace Tests\Unit;

use App\Employee;
use Tests\TestCase;
use App\Company;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testCompanyCanBeDeleted()
    {
        $company = factory(Company::class)->create(['name' => 'test', 'email' => 'test@gmail.com']);

        $employee1 = factory(Employee::class)->create(['company' => $company->id]);
        $employee2 = factory(Employee::class)->create(['company' => $company->id]);

        $company->delete();

        $this->assertDatabaseMissing('companies',['name' => 'test','email' => 'test@gmail.com']);
        $this->assertDatabaseMissing('employees',['id' => $employee1->id]);
        $this->assertDatabaseMissing('employees',['id' => $employee2->id]);

    }

    public function testCompanyCanBeCreated()
    {
        $company = factory(Company::class)->create(['name' => 'Testname', 'email' => 'test@gmail.com']);
        $latest_company = $company->latest()->first();
        $this->assertEquals($company->id, $latest_company->id);
        $this->assertEquals('Testname', $latest_company->name);
        $this->assertEquals('test@gmail.com', $latest_company->email);
        $this->assertDatabaseHas('companies', ['id' => $company->id, 'name' => 'Testname', 'email' => 'test@gmail.com']);
    }

    public function testCompanyCanBeEdited(){

        $company = factory(Company::class)->create(['name' => 'Testname', 'email' => 'test@gmail.com']);
        $this->assertDatabaseHas('companies', ['id' => $company->id, 'name' => 'Testname', 'email' => 'test@gmail.com']);

        $company->name = 'newname';
        $company->email = 'new@gmail.com';
        $company->website = 'newwebsite';
        $company->logo = 'noimage.png';
        $company->save();

        $this->assertDatabaseHas('companies', ['id' => $company->id, 'name' => 'newname', 'email' => 'new@gmail.com','website' => 'newwebsite','logo' => 'noimage.png']);

    }



}
