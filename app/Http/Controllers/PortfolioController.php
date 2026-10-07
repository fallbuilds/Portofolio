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
                'title' => 'Jagoan Pay',
                'description' => 'Website Company Profile / Landing Page (Client Project) untuk aplikasi PPOB Jagoan Pay. Menampilkan fitur unggulan, simulasi keuntungan, dan konversi ke unduhan aplikasi mobile.',
                'technologies' => ['HTML', 'Tailwind CSS', 'JavaScript', 'Landing Page'],
                'github_url' => null,
                'demo_url' => 'https://jagoanpayment.com/',
                'featured' => true,
                'image' => 'images/jagoan-pay.png'
            ],
            (object) [
                'title' => 'Ling Pedia',
                'description' => 'Aplikasi web toko online (PPOB) untuk pembelian layanan digital, cek transaksi, dan manajemen jasa dengan antarmuka yang modern dan responsif.',
                'technologies' => ['Laravel', 'Tailwind CSS', 'MySQL', 'API'],
                'github_url' => null,
                'demo_url' => null,
                'featured' => true,
                'image' => 'images/ling-pedia.png'
            ],
            (object) [
                'title' => 'SakuRakyat API\'s',
                'description' => 'Portal REST API yang bersih, cepat, dan tangguh untuk developer. Dilengkapi dengan dokumentasi interaktif, manajemen API Key, dan pantauan status sistem real-time.',
                'technologies' => ['Laravel', 'REST API', 'Tailwind CSS'],
                'github_url' => null,
                'demo_url' => null,
                'featured' => true,
                'image' => 'images/sakurakyat-api.png'
            ]
        ];

        $skills = [
            // Backend
            (object) ['name' => 'Laravel', 'level' => 90, 'category' => 'backend'],
            (object) ['name' => 'PHP', 'level' => 85, 'category' => 'backend'],
            (object) ['name' => 'Java', 'level' => 75, 'category' => 'backend'],
            (object) ['name' => 'REST API', 'level' => 85, 'category' => 'backend'],
            (object) ['name' => 'MySQL', 'level' => 82, 'category' => 'backend'],
            
            // Frontend
            (object) ['name' => 'JavaScript', 'level' => 85, 'category' => 'frontend'],
            (object) ['name' => 'React', 'level' => 75, 'category' => 'frontend'],
            (object) ['name' => 'Tailwind CSS', 'level' => 90, 'category' => 'frontend'],
            (object) ['name' => 'HTML', 'level' => 95, 'category' => 'frontend'],
            (object) ['name' => 'CSS', 'level' => 90, 'category' => 'frontend'],
            (object) ['name' => 'Bootstrap', 'level' => 80, 'category' => 'frontend'],

            // Mobile & Tools
            (object) ['name' => 'Flutter', 'level' => 80, 'category' => 'mobile'],
            (object) ['name' => 'Dart', 'level' => 75, 'category' => 'mobile'],
            (object) ['name' => 'Git', 'level' => 85, 'category' => 'tools'],
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
