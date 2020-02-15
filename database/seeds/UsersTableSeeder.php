<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'https://cdn.learnku.com/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];

        // 生成数据集合
        $users = factory(User::class)
                        ->times(10)
                        ->make()
                        ->each(function ($user, $index)
                            use ($faker, $avatars)
        {
            // 从头像数组中随机取出一个并赋值
            $user->avatar = $faker->randomElement($avatars);
        });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'MuQ';
        $user->email = 'muq971118@gmail.com';
        $user->password = '$2y$10$4fc4kczZtIBmeDZmEms7neeuHAC25fZBJSNn3oomGn551C6.TIDRG';
        $user->remember_token = Str::random(10);
        $user->avatar = 'http://muqlaravel.test/uploads/images/avatars/202002/13/1_1581596173_NdBhmRvvci.jpg';
        $user->introduction = "I'm MuQ";
        $user->save();
        
        $user->assignRole('Founder');

        $user = User::find(2);
        $user->name = 'Five-Seven';
        $user->email = '865276519@qq.com';
        $user->password = '$2y$10$4fc4kczZtIBmeDZmEms7neeuHAC25fZBJSNn3oomGn551C6.TIDRG';
        $user->remember_token = Str::random(10);
        $user->avatar = 'http://muqlaravel.test/uploads/images/avatars/202002/13/1_1581596173_NdBhmRvvci.jpg';
        $user->introduction = "I'm MuQ";
        $user->save();
        
        $user->assignRole('Maintainer');
    }
}
