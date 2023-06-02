<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Demo extends Seeder
{
    public function run()
    {
        $authorize = $auth = service('authorization');
        $authorize->addUserToGroup(1, 'admin');
    }
}
