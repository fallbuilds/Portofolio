<?php

namespace App\Http\Controllers;

class PortfolioController extends Controller
{
    public function index()
    {
        // STATIS DATA: Karena tidak mau pakai database
        $projects = [
            (object) [
                'title' => 'JMB Cargo',
                'description' => 'Sistem manajemen pengiriman barang dengan fitur tracking real-time, invoice otomatis, dan dashboard analytics.',
                'technologies' => ['Laravel', 'PHP', 'MySQL', 'Tailwind CSS'],
                'github_url' => null,
                'demo_url' => 'https://jmbcargo.com',
                'featured' => true,
                'image' => 'images/jmb-cargo.png'
            ],
            (object) [
                'title' => 'TugasKu',
                'description' => 'Aplikasi task management mobile dengan fitur kolaborasi tim, reminder, dan integrasi calendar.',
                'technologies' => ['Flutter', 'Laravel API', 'MySQL'],
                'github_url' => null,
                'demo_url' => null,
                'featured' => true,
            ],
            (object) [
                'title' => 'Sistem Informasi Akademik',
                'description' => 'Platform manajemen data akademik sekolah dengan fitur portal nilai siswa, absensi digital, dan rekapitulasi laporan otomatis.',
                'technologies' => ['Laravel', 'MySQL', 'Bootstrap', 'REST API'],
                'github_url' => null,
                'demo_url' => null,
                'featured' => true,
            ],
            (object) [
                'title' => 'Ling Pedia',
                'description' => 'Aplikasi web toko online (PPOB) untuk pembelian layanan digital, cek transaksi, dan manajemen jasa dengan antarmuka yang modern dan responsif.',
                'technologies' => ['Laravel', 'Tailwind CSS', 'MySQL', 'API'],
                'github_url' => null,
                'demo_url' => null,
                'featured' => true,
                'image' => 'images/ling-pedia.png'
            ]
        ];

        $skills = [
            (object) ['name' => 'Laravel', 'level' => 90, 'category' => 'backend'],
            (object) ['name' => 'PHP', 'level' => 85, 'category' => 'backend'],
            (object) ['name' => 'JavaScript', 'level' => 80, 'category' => 'frontend'],
            (object) ['name' => 'HTML', 'level' => 95, 'category' => 'frontend'],
            (object) ['name' => 'CSS', 'level' => 90, 'category' => 'frontend'],
            (object) ['name' => 'Tailwind CSS', 'level' => 88, 'category' => 'frontend'],
            (object) ['name' => 'Bootstrap', 'level' => 85, 'category' => 'frontend'],
            (object) ['name' => 'MySQL', 'level' => 82, 'category' => 'backend'],
            (object) ['name' => 'Git', 'level' => 80, 'category' => 'tools'],
            (object) ['name' => 'REST API', 'level' => 85, 'category' => 'backend'],
            (object) ['name' => 'Flutter', 'level' => 70, 'category' => 'mobile'],
            (object) ['name' => 'Three.js', 'level' => 65, 'category' => 'frontend'],
        ];

        $experiences = [
            (object) [
                'year' => '2021 - 2024',
                'title' => 'Learning & Foundations',
                'description' => 'Memulai perjalanan di dunia pemrograman. Mempelajari HTML, CSS, JavaScript, dan membangun fondasi logika algoritma dasar.',
                'type' => 'education'
            ],
            (object) [
                'year' => '2024 - 2026',
                'title' => 'Backend & Laravel Development',
                'description' => 'Mendalami framework Laravel dan PHP. Mulai mengerjakan proyek-proyek manajemen data, sistem informasi, dan API backend.',
                'type' => 'work'
            ],
            (object) [
                'year' => '2026 - Sekarang',
                'title' => 'Advanced Full Stack Development',
                'description' => 'Membangun dan merancang sistem berskala menengah hingga besar dengan arsitektur modern (TALL stack, Flutter, dll).',
                'type' => 'project'
            ]
        ];

        return view('home', compact('projects', 'skills', 'experiences'));
    }
}
