<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'JMB Cargo',
                'description' => 'Sistem ERP ekspedisi kargo cerdas dengan fitur live tracking pengiriman, otomatisasi manifest & invoice digital, kalkulator ongkir otomatis, dan dashboard analytic performa armada.',
                'technologies' => ['Laravel', 'PHP', 'MySQL', 'Tailwind CSS', 'REST API'],
                'github_url' => null,
                'demo_url' => 'https://jasamultiberkah.com/',
                'featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'TugasKu',
                'description' => 'Aplikasi kolaborasi dan task management mobile dengan timeline kanban board interaktif, push reminder, role-based project space, dan integrasi cloud storage.',
                'technologies' => ['Flutter', 'Laravel API', 'MySQL', 'Firebase'],
                'github_url' => null,
                'demo_url' => null,
                'featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Sistem Informasi Akademik',
                'description' => 'Platform manajemen data akademik sekolah dengan fitur portal nilai siswa, absensi digital, dan rekapitulasi laporan otomatis.',
                'technologies' => ['Laravel', 'MySQL', 'Bootstrap', 'REST API'],
                'github_url' => null,
                'demo_url' => null,
                'featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Finix E-Commerce',
                'description' => 'Platform toko online modern dengan integrasi payment gateway otomatis, manajemen stok multivariasi, keranjang belanja interaktif, dan notifikasi WhatsApp webhook.',
                'technologies' => ['Laravel', 'MySQL', 'Tailwind CSS', 'Midtrans API'],
                'github_url' => null,
                'demo_url' => null,
                'featured' => false,
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $project) {
            Project::create([
                'title' => $project['title'],
                'slug' => Str::slug($project['title']),
                'description' => $project['description'],
                'technologies' => $project['technologies'],
                'github_url' => $project['github_url'] ?? null,
                'demo_url' => $project['demo_url'] ?? null,
                'featured' => $project['featured'],
                'sort_order' => $project['sort_order'],
            ]);
        }

        $skills = [
            [
                'name' => 'Laravel',
                'icon' => 'laravel',
                'category' => 'backend',
                'level' => 90,
                'sort_order' => 1,
            ],
            [
                'name' => 'PHP',
                'icon' => 'php',
                'category' => 'backend',
                'level' => 85,
                'sort_order' => 2,
            ],
            [
                'name' => 'JavaScript',
                'icon' => 'javascript',
                'category' => 'frontend',
                'level' => 80,
                'sort_order' => 3,
            ],
            [
                'name' => 'HTML',
                'icon' => 'html',
                'category' => 'frontend',
                'level' => 95,
                'sort_order' => 4,
            ],
            [
                'name' => 'CSS',
                'icon' => 'css',
                'category' => 'frontend',
                'level' => 90,
                'sort_order' => 5,
            ],
            [
                'name' => 'Tailwind CSS',
                'icon' => 'tailwind',
                'category' => 'frontend',
                'level' => 88,
                'sort_order' => 6,
            ],
            [
                'name' => 'Bootstrap',
                'icon' => 'bootstrap',
                'category' => 'frontend',
                'level' => 85,
                'sort_order' => 7,
            ],
            [
                'name' => 'MySQL',
                'icon' => 'mysql',
                'category' => 'backend',
                'level' => 82,
                'sort_order' => 8,
            ],
            [
                'name' => 'Git',
                'icon' => 'git',
                'category' => 'tools',
                'level' => 80,
                'sort_order' => 9,
            ],
            [
                'name' => 'REST API',
                'icon' => 'api',
                'category' => 'backend',
                'level' => 85,
                'sort_order' => 10,
            ],
            [
                'name' => 'Flutter',
                'icon' => 'flutter',
                'category' => 'mobile',
                'level' => 70,
                'sort_order' => 11,
            ],
            [
                'name' => 'Three.js',
                'icon' => 'threejs',
                'category' => 'frontend',
                'level' => 65,
                'sort_order' => 12,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        $experiences = [
            [
                'year' => '2021',
                'title' => 'Langkah Pertama di Dunia Coding',
                'description' => 'Memulai perjalanan di dunia pemrograman karena rasa penasaran. Mempelajari logika dasar, HTML, CSS, dan mulai membuat website sederhana pertama saya.',
                'type' => 'education',
                'sort_order' => 1,
            ],
            [
                'year' => '2024',
                'title' => 'Mendalami Backend & Sistem',
                'description' => 'Mulai mendalami bahasa pemrograman backend seperti PHP dan framework Laravel. Berhasil membangun beberapa proyek nyata termasuk JMB Cargo dan aplikasi sekolah.',
                'type' => 'work',
                'sort_order' => 2,
            ],
            [
                'year' => '2026 - Sekarang',
                'title' => 'Advanced Full Stack Development',
                'description' => 'Terus mengembangkan kemampuan sebagai Full Stack Developer. Membangun dan merancang sistem berskala menengah hingga besar dengan arsitektur modern.',
                'type' => 'project',
                'sort_order' => 3,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::create($experience);
        }
    }
}
