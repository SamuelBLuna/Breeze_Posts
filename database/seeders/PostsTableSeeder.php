<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'user_id' => 1,
                'title' => 'Primeiro post do administrador',
                'text' => 'Esté é o primeiro post do administrador. Sejam bem vindos a comunidade'
            ],
            [
                'user_id' => 1,
                'title' => 'Uma nota importante',
                'text' => 'Todos os usuários devem manter o respeito mútuo e a cordialidade nas interações'
            ],
            [
                'user_id' => 2,
                'title' => 'Olá a todos!',
                'text' => 'O meu nome é João, acabei de me resgistrar, estou muito feliz de fazer parte da comunidade'
            ],
            [
                'user_id' => 1,
                'title' => 'Bem-vindo João!',
                'text' => 'Muito obrigado por se juntar a nós, João. Espero que se sinta em casa'
            ],
            [
                'user_id' => 2,
                'title' => 'Muito obrigado',
                'text' => 'Valeu adm, estou muito feliz por fazer parte da comunidade junto com todos vcs'
            ],
        ];

        DB::table('posts')->insert($posts);
    }
}
