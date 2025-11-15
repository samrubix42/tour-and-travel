<?php

namespace App\View\Builders;

use Illuminate\Support\Collection;

class AdminSidebar
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public static function menu($user): self
    {
        return new self($user);
    }

    public function get(): Collection
    {
        $menu = collect([
            (object)[
                'title' => 'Category',
                'icon' => 'ti ti-layout-dashboard',
                'url' => route('admin.category.list'),
                'hasSubmenu' => false,
                'submenu' => [],
            ],
            (object)[
                'title' => 'Destinations',
                'icon' => 'ti ti-layout-dashboard',
                'url' => route('admin.destination.list'),
                'hasSubmenu' => false,
                'submenu' => [],
            ],
            (object)[
                'title' => 'Hotel Categories',
                'icon' => 'ti ti-layout-dashboard',
                'url' => route('admin.hotel-category.list'),
                'hasSubmenu' => false,
                'submenu' => [],
            ],
            (object)[
                'title' => 'Hotel',
                'icon' => 'ti ti-layout-dashboard',
                'url' => route('admin.hotel.list'),
                'hasSubmenu' => false,
                'submenu' => [],
            ],
            // (object)[
            //     'title' => 'Users',
            //     'icon' => 'ti ti-users',
            //     'url' => '#',
            //     'hasSubmenu' => false,
            // ],
            // (object)[
            //     'title' => 'Services',
            //     'icon' => 'ti ti-tools',
            //     'url' => '#',
            //     'hasSubmenu' => false,
            // ],
            // (object)[
            //     'title' => 'Service Requests',
            //     'icon' => 'ti ti-inbox',
            //     'url' => '#',
            //     'hasSubmenu' => false,

            // ],
            // (object)[
            //     'title' => 'Registrations',
            //     'icon' => 'ti ti-clipboard-list',
            //     'url' => '#',
            //     'hasSubmenu' => false,

            // ],
            // (object)[
            //     'title' => 'Case Study',
            //     'icon' => 'ti ti-briefcase',
            //     'url' => '#',
            //     'hasSubmenu' => true,
            //     'submenu' => [
            //         (object)['title' => 'Case Categories', 'url' => '#'],
            //         (object)['title' => 'Case Studies', 'url' => '#'],
            //     ],
            // ],
            // (object)[
            //     'title' => 'Blogs',
            //     'icon' => 'ti ti-article',
            //     'url' => '#',
            //     'hasSubmenu' => true,
            //     'submenu' => [
            //         (object)['title' => 'Categories', 'url' => '#'],
            //         (object)['title' => 'Blogs', 'url' => '#'],
            //     ],
            // ],
            // (object)[
            //     'title' => 'Testimonials',
            //     'icon' => 'ti ti-star',
            //     'url' => '#',
            //     'hasSubmenu' => false,

            // ],
            // (object)[
            //     'title' => 'Faq',
            //     'icon' => 'ti ti-help-circle',
            //     'url' => '#',
            //     'hasSubmenu' => false,

            // ],
            // (object)[
            //     'title' => 'Contacts',
            //     'icon' => 'ti ti-mail',
            //     'url' => '#',
            //     'hasSubmenu' => false,

            // ],
            // (object)[
            //     'title' => 'Settings',
            //     'icon' => 'ti ti-settings',
            //     'url' => '#',
            //     'hasSubmenu' => false,

            // ],
        ]);
        return $menu;
    }
}
