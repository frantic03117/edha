<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [
            ['loc' => url('/'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => url('about'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => url('contact-us'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => url('faqs'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => url('csr'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => url('login'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['loc' => url('expert-join'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['loc' => url('signup'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['loc' => url('gallery'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => url('blogs'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => url('videos'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.7'],
            ['loc' => url('counselling'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => url('coaching'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => url('opening-position'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => url('policy/privacy-policy'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'yearly', 'priority' => '0.5'],
            ['loc' => url('policy/terms-conditions'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'yearly', 'priority' => '0.5'],
            ['loc' => url('policy/cancellation-policy'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'yearly', 'priority' => '0.5'],
        ];

        // Fetch categories and subcategories
        $items = Category::with('subcategory')->get();
        foreach ($items as $catg) {
            $urls[] = [
                'loc' => url($catg['url']),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
            foreach ($catg['subcategory'] as $s) {
                $urls[] = [
                    'loc' => url($catg['url'] . '/' . $s['url']),
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.7',
                ];
            }
        }

        // Fetch blog URLs with last modified date
        $blogs = Blog::select(['url', 'created_at'])->get();
        foreach ($blogs as $blg) {
            $urls[] = [
                'loc' => url('article/' . $blg['url']),
                'lastmod' => $blg->created_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => now()->diffInDays($blg->created_at) < 7 ? '0.9' : '0.6', // Higher priority for recent blogs
            ];
        }

        return response()->view('sitemap', compact('urls'))->header('Content-Type', 'application/xml');
    }
    public function htmlview()
    {
        $urls = [
            ['loc' => url('/'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => url('about'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => url('contact-us'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => url('faqs'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => url('csr'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => url('login'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['loc' => url('expert-join'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['loc' => url('signup'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['loc' => url('gallery'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => url('blogs'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => url('videos'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.7'],
            ['loc' => url('counselling'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => url('coaching'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => url('opening-position'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => url('policy/privacy-policy'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'yearly', 'priority' => '0.5'],
            ['loc' => url('policy/terms-conditions'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'yearly', 'priority' => '0.5'],
            ['loc' => url('policy/cancellation-policy'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'yearly', 'priority' => '0.5'],
        ];

        // Fetch categories and subcategories
        $items = Category::with('subcategory')->get();
        foreach ($items as $catg) {
            $urls[] = [
                'loc' => url($catg['url']),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
            foreach ($catg['subcategory'] as $s) {
                $urls[] = [
                    'loc' => url($catg['url'] . '/' . $s['url']),
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.7',
                ];
            }
        }

        // Fetch blog URLs with last modified date
        $blogs = Blog::select(['url', 'created_at'])->get();
        foreach ($blogs as $blg) {
            $urls[] = [
                'loc' => url('article/' . $blg['url']),
                'lastmod' => $blg->created_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => now()->diffInDays($blg->created_at) < 7 ? '0.9' : '0.6', // Higher priority for recent blogs
            ];
        }

        return response()->view('sitemap-html', compact('urls'));
    }
}