<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReferenceType;
use App\Models\Admin\InfoPersonal;
use App\Models\Master\MastDepartment;
use App\Models\Master\MastDesignation;
use App\Models\Master\MastEmployeeType;
use App\Models\Master\MastWorkStation;
use App\Models\Master\MastLeave;
use App\Models\Master\MastPackage;
use App\Models\Master\MastUnit;
use App\Models\Master\MastItemCategory;
use App\Models\Master\MastItemGroup;
use App\Models\Master\MastItemRegister;
use App\Models\Master\MastSupplier;
use App\Models\Master\MastCustomerType;
use App\Models\Master\MastCustomer;
use App\Models\Master\MastComplaintType;

class ImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //______________MASTER________________//
        MastDepartment::create([
            'dept_name'=>'Air Condition Sales',
            'dept_head'=>'1',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDepartment::create([
            'dept_name'=>'Air Condition Service',
            'dept_head'=>'1',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDepartment::create([
            'dept_name'=>'HR & Admin',
            'dept_head'=>'1',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDepartment::create([
            'dept_name'=>'Car Spear Parts',
            'dept_head'=>'1',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDepartment::create([
            'dept_name'=>'Store',
            'dept_head'=>'1',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDepartment::create([
            'dept_name'=>'Wear House',
            'dept_head'=>'1',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDepartment::create([
            'dept_name'=>'Accounts & Finnance',
            'dept_head'=>'1',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        //____________________________________//
        MastDesignation::create([
            'desig_name'=>'G.M (Sales & Admin)',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'AGM Finance & Accounts',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Jr. Manager',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Executive Officer (Sales & Service)',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Sales Excecutive',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Manager Sales',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Sr. Manager Sales',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'General Manager (Commercial Division)',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Managing Director',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Head of Engineer (Service Section)',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'A.G.M Sales',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Excecutive (Accounts)',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Tecnichian',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Director',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Store In-Charge',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Helper',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Security',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Store Keper',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Electronics Tec.',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Service Supervisor (Sr. Tec)',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Peon',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Welding Technician',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Driver',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Security In-charge',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Imam',
            'description'=> null,
            'status'=>'1',
            'user_id'=>'1'
        ]);
        //____________________________________//
        MastEmployeeType::create([
            'cat_name'=>'Full-Time',
            'cat_type'=>'1',
            'description'=>'These are employees who work for the company on a regular basis and are typically paid a salary or an hourly wage. They may be eligible for benefits such as health insurance, retirement plans, and paid time off.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastEmployeeType::create([
            'cat_name'=>'Half-Time',
            'cat_type'=>'1',
            'description'=>'These are employees who work for the company on a part-time basis, usually less than 40 hours per week. They may be paid an hourly wage and may or may not be eligible for benefits depending on the company policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastEmployeeType::create([
            'cat_name'=>'Contract',
            'cat_type'=>'1',
            'description'=>'These are individuals who work for the company on a temporary basis and are usually hired to perform a specific job or task. They may be paid a flat fee or an hourly rate and are typically not eligible for benefits.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastEmployeeType::create([
            'cat_name'=>'Interns',
            'cat_type'=>'1',
            'description'=>'These are students or recent graduates who work for the company on a temporary basis to gain work experience and develop skills. They may be paid a stipend or may work for free, and are typically not eligible for benefits.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastEmployeeType::create([
            'cat_name'=>'Consultants',
            'cat_type'=>'1',
            'description'=>'These are individuals or firms who are hired by the company to provide specialized expertise or services on a project basis. They may be paid a flat fee or an hourly rate and are typically not eligible for benefits.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastEmployeeType::create([
            'cat_name'=>'Seasonal Employees',
            'cat_type'=>'1',
            'description'=>'These are employees who work for the company during specific times of the year when there is a higher demand for the companys products or services. They may be paid an hourly wage and may or may not be eligible for benefits depending on the companys policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);

        //____________________________________//
        MastLeave::create([
            'leave_name'=>'Personal Leave',
            'max_limit'=>'5',
            'leave_code'=>'01',
            'yearly_limit'=>'2',
            'description'=>'N/A',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastLeave::create([
            'leave_name'=>'Sick Leave',
            'max_limit'=>'20',
            'leave_code'=>'02',
            'yearly_limit'=>'3',
            'description'=>'N/A',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastLeave::create([
            'leave_name'=>'Casual',
            'max_limit'=>'10',
            'leave_code'=>'03',
            'yearly_limit'=>'2',
            'description'=>'N/A',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastLeave::create([
            'leave_name'=>'Vacation leave (Annual leave)',
            'max_limit'=>'6',
            'leave_code'=>'04',
            'yearly_limit'=>'1',
            'description'=>'N/A',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastLeave::create([
            'leave_name'=>'Unpaid leave (or leave without pay)',
            'max_limit'=>'3',
            'leave_code'=>'05',
            'yearly_limit'=>'5',
            'description'=>'N/A',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastLeave::create([
            'leave_name'=>'Study leave',
            'max_limit'=>'40',
            'leave_code'=>'06',
            'yearly_limit'=>'2',
            'description'=>'N/A',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        //____________________________________//
        MastWorkStation::create([
            'store_name'=>'Central Storehouse',
            'contact_number'=>'01995275933',
            'location'=>'Gulshan',
            'description'=>'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastWorkStation::create([
            'store_name'=>'Gulf international associates ltd.',
            'contact_number'=>'01995275933',
            'location'=>'Gulshan',
            'description'=>'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastWorkStation::create([
            'store_name'=>'Icon information Systems ltd.',
            'contact_number'=>'01995275933',
            'location'=>'Mirpur',
            'description'=>'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        //____________________________________//
        MastItemCategory::create([
            'cat_name'=>'AC',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastItemCategory::create([
            'cat_name'=>'AC Spare Parts',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastItemCategory::create([
            'cat_name'=>'Car Spare Parts',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastItemCategory::create([
            'cat_name'=>'Tools Requisition',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        //____________________________________//
        MastItemGroup::create([
            'part_name'=>'Window Air Conditioners',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1',
            'mast_item_category_id'=>'1'
        ]);
        MastItemGroup::create([
            'part_name'=>'Split Air Conditioners',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1',
            'mast_item_category_id'=>'1'
        ]);
        MastItemGroup::create([
            'part_name'=>'Central Air Conditioning',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1',
            'mast_item_category_id'=>'1'
        ]);
        MastItemGroup::create([
            'part_name'=>'ARM BUSHING',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1',
            'mast_item_category_id'=>'3'
        ]);
        MastItemGroup::create([
            'part_name'=>'SUSPENSION BUSH',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1',
            'mast_item_category_id'=>'3'
        ]);
        MastItemGroup::create([
            'part_name'=>'REAR SUSPENSION BUSH',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1',
            'mast_item_category_id'=>'3'
        ]);
        MastItemGroup::create([
            'part_name'=>'SPRIN SHACKLE BUSH',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1',
            'mast_item_category_id'=>'3'
        ]);
        MastItemGroup::create([
            'part_name'=>'SHOCK ABSORBER BUSH',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1',
            'mast_item_category_id'=>'3'
        ]);
        MastItemGroup::create([
            'part_name'=>'SUPRING SHACKLE RUBBER',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1',
            'mast_item_category_id'=>'3'
        ]);
        MastItemGroup::create([
            'part_name'=>'UP ARM BUSHING',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1',
            'mast_item_category_id'=>'3'
        ]);
        MastItemGroup::create([
            'part_name'=>'FONT LOWER ARM BUSH',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1',
            'mast_item_category_id'=>'3'
        ]);
        //____________________________________//
        MastPackage::create([
            'pkg_name'=>'1 X 1',
            'pkg_size'=>'1',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastPackage::create([
            'pkg_name'=>'1 X 4',
            'pkg_size'=>'4',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastPackage::create([
            'pkg_name'=>'1 X 6',
            'pkg_size'=>'6',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastPackage::create([
            'pkg_name'=>'1 X 8',
            'pkg_size'=>'8',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastPackage::create([
            'pkg_name'=>'1 X 10',
            'pkg_size'=>'10',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastPackage::create([
            'pkg_name'=>'1 X 12',
            'pkg_size'=>'12',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastPackage::create([
            'pkg_name'=>'1 X 16',
            'pkg_size'=>'16',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastPackage::create([
            'pkg_name'=>'1 X 20',
            'pkg_size'=>'20',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastPackage::create([
            'pkg_name'=>'1 X 24',
            'pkg_size'=>'24',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastPackage::create([
            'pkg_name'=>'1 X 36',
            'pkg_size'=>'36',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastPackage::create([
            'pkg_name'=>'1 X 48',
            'pkg_size'=>'48',
            'description'=>'',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        //____________________________________//
        MastUnit::create([
            'unit_name'=>'Set (set)',
            'description'=>'Count',
            'status'=>'1',
            'mast_item_category_id'=> '1',
            'user_id'=>'1'
        ]);
        MastUnit::create([
            'unit_name'=>'Piece (pcs)',
            'description'=>'Count',
            'status'=>'1',
            'mast_item_category_id'=> '1',
            'user_id'=>'1'
        ]);
        MastUnit::create([
            'unit_name'=>'Dozen (doz)',
            'description'=>'Count',
            'status'=>'2',
            'mast_item_category_id'=> '2',
            'user_id'=>'1'
        ]);
        MastUnit::create([
            'unit_name'=>'Pack (pk)',
            'description'=>'Count',
            'status'=>'1',
            'mast_item_category_id'=> '3',
            'user_id'=>'1'
        ]);
        MastUnit::create([
            'unit_name'=>'Milligram (mg)',
            'description'=>'Weight/Mass',
            'mast_item_category_id'=> '3',
            'user_id'=>'1',
            'status'=>'1',
        ]);
        MastUnit::create([
            'unit_name'=>'Gram (g)',
            'description'=>'Weight/Mass',
            'mast_item_category_id'=> '3',
            'user_id'=>'1',
            'status'=>'1',
        ]);
        MastUnit::create([
            'unit_name'=>'Kilogram (kg)',
            'description'=>'Weight/Mass',
            'mast_item_category_id'=> '2',
            'user_id'=>'1',
            'status'=>'1',
        ]);
        MastUnit::create([
            'unit_name'=>'Metric Ton (MT)',
            'description'=>'Weight/Mass',
            'mast_item_category_id'=> '2',
            'user_id'=>'1',
            'status'=>'1',
        ]);
        MastUnit::create([
            'unit_name'=>'Ounce (oz)',
            'description'=>'Weight/Mass',
            'mast_item_category_id'=> '2',
            'user_id'=>'1',
            'status'=>'1',
        ]);
        MastUnit::create([
            'unit_name'=>'Pound (lb)',
            'description'=>'Weight/Mass',
            'mast_item_category_id'=> '2',
            'user_id'=>'1',
            'status'=>'1',
        ]);
        MastUnit::create([
            'unit_name'=>'Square Meter (m²)',
            'description'=>'Area',
            'mast_item_category_id'=> '2',
            'user_id'=>'1',
            'status'=>'1',
        ]);
        MastUnit::create([
            'unit_name'=>'Square Foot (sq ft)',
            'description'=>'Area',
            'mast_item_category_id'=> '3',
            'user_id'=>'1',
            'status'=>'1',
        ]);
        MastUnit::create([
            'unit_name'=>'Acre (ac)',
            'description'=>'Area',
            'mast_item_category_id'=> '3',
            'user_id'=>'1',
            'status'=>'1',
        ]);
        MastUnit::create([
            'unit_name'=>'Square Kilometer (sq km)',
            'description'=>'Area',
            'status'=>'1',
            'mast_item_category_id'=> '2',
            'user_id'=>'1'
        ]);
        //____________________________________//
        MastItemRegister::create([
            'box_code'=>'5',
            'gulf_code'=>'2',
            'part_no'=>'1178598',
            'description'=>'Test Only1',
            'box_qty'=>'12',
            'price'=>'7500',
            'image'=>'',
            'warranty'=>'12',
            'mast_item_category_id'=>'1',
            'bar_code'=>'97049180517',
            'user_id'=>'1',
            'mast_item_group_id'=>'1',
            'unit_id'=>'6',
        ]);
        MastItemRegister::create([
            'box_code'=>'5',
            'gulf_code'=>'2',
            'part_no'=>'1278598',
            'description'=>'Test Only2',
            'box_qty'=>'12',
            'price'=>'9500',
            'image'=>'',
            'warranty'=>'12',
            'mast_item_category_id'=>'1',
            'bar_code'=>'97049180517',
            'user_id'=>'1',
            'mast_item_group_id'=>'1',
            'unit_id'=>'6',
        ]);
        MastItemRegister::create([
            'box_code'=>'9',
            'gulf_code'=>'7',
            'part_no'=>'1078598',
            'description'=>'Test Only3',
            'box_qty'=>'16',
            'price'=>'10000',
            'image'=>'',
            'warranty'=>'12',
            'mast_item_category_id'=>'1',
            'bar_code'=>'98049180517',
            'user_id'=>'1',
            'mast_item_group_id'=>'2',
            'unit_id'=>'8',
        ]);
        //____________________________________//
        MastSupplier::create([
            'supplier_name'=>'Alam',
            'contact_person'=>'Sagour Khan',
            'email'=>'alam@gmail.com',
            'phone_number'=>'01995275933',
            'address'=>'Shariatpur',
            'user_id'=>'1',
        ]);
        MastSupplier::create([
            'supplier_name'=>'Sabbir',
            'contact_person'=>'Sagour Khan',
            'email'=>'sabbir@gmail.com',
            'phone_number'=>'01995275933',
            'address'=>'Shariatpur',
            'user_id'=>'1',
        ]);
        MastSupplier::create([
            'supplier_name'=>'Minhaz',
            'contact_person'=>'Sagour Khan',
            'email'=>'minhaz@gmail.com',
            'phone_number'=>'01995275933',
            'address'=>'Shariatpur',
            'user_id'=>'1',
        ]);
        //____________________________________//
        MastCustomerType::create([
            'name'=>'Corporate',
            'status'=>'1',
        ]);
        MastCustomerType::create([
            'name'=>'Distributer',
            'status'=>'1',
        ]);
        MastCustomerType::create([
            'name'=>'Retailer',
            'status'=>'1',
        ]);
        //____________________________________//
        MastCustomer::create([
            'name'=>'Motiur Rahman',
            'email'=>'motiur.cmt@gmail.com',
            'phone'=>'01913954378',
            'address'=>'Shariatpur',
            'cont_person'=>'Sagour Khan',
            'cont_designation'=>'Teacher',
            'cont_phone'=>'01922437143',
            'cont_email'=>'sagour@gmail.com',
            'web_address'=>'',
            'credit_limit'=>'1000000',
            'remarks'=>'Test Only',
            'status'=>'1',
            'mast_customer_type_id'=>'1',
            'user_id'=>'1',
        ]);
        MastCustomer::create([
            'name'=>'Sabbir',
            'email'=>'tayfa@gmail.com',
            'phone'=>'01913954378',
            'address'=>'Shariatpur',
            'cont_person'=>'Alam Khan',
            'cont_designation'=>'Teacher',
            'cont_phone'=>'01922437143',
            'cont_email'=>'sagour@gmail.com',
            'web_address'=>'',
            'credit_limit'=>'1000000',
            'remarks'=>'Test Only',
            'status'=>'1',
            'mast_customer_type_id'=>'1',
            'user_id'=>'1',
        ]);
        MastCustomer::create([
            'name'=>'Minhaz',
            'email'=>'tayfa@gmail.com',
            'phone'=>'01913954378',
            'address'=>'Shariatpur',
            'cont_person'=>'Sagour Khan',
            'cont_designation'=>'Teacher',
            'cont_phone'=>'01922437143',
            'cont_email'=>'tamim@gmail.com',
            'web_address'=>'',
            'credit_limit'=>'1000000',
            'remarks'=>'Test Only',
            'status'=>'1',
            'mast_customer_type_id'=>'1',
            'user_id'=>'1',
        ]);
        MastCustomer::create([
            'name'=>'Tamim',
            'email'=>'tayfa@gmail.com',
            'phone'=>'01913954378',
            'address'=>'Shariatpur',
            'cont_person'=>'Motiur Khan',
            'cont_designation'=>'Teacher',
            'cont_phone'=>'01922437143',
            'cont_email'=>'sagour@gmail.com',
            'web_address'=>'',
            'credit_limit'=>'1000000',
            'remarks'=>'Test Only',
            'status'=>'1',
            'mast_customer_type_id'=>'2',
            'user_id'=>'1',
        ]);
        MastCustomer::create([
            'name'=>'Tayfa Islam',
            'email'=>'tayfa@gmail.com',
            'phone'=>'01913954378',
            'address'=>'Shariatpur',
            'cont_person'=>'Sagour Khan',
            'cont_designation'=>'Teacher',
            'cont_phone'=>'01922437143',
            'cont_email'=>'koli@gmail.com',
            'web_address'=>'',
            'credit_limit'=>'1000000',
            'remarks'=>'Test Only',
            'status'=>'1',
            'mast_customer_type_id'=>'3',
            'user_id'=>'1',
        ]);
        //____________________________________//
        MastComplaintType::create([
            'name'=>'Service Problem',
            'description'=>'TEST-01',
            'status'=>'1',
            'user_id'=>'1',
        ]);
        MastComplaintType::create([
            'name'=>'Gass Problem',
            'description'=>'TEST-01',
            'status'=>'1',
            'user_id'=>'1',
        ]);
    }
}
