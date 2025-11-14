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
                'title' => 'Dashboard',
                'icon' => 'ti ti-layout-dashboard',
                'url' => route('admin.dashboard'),
                'hasSubmenu' => false,
                'submenu' => [],
            ],
            (object)[
                'title' => 'Users',
                'icon' => 'ti ti-users',
                'url' => route('admin.users'),
                'hasSubmenu' => false,
            ],
            (object)[
                'title' => 'Services',
                'icon' => 'ti ti-tools',
                'url' => route('admin.services'),
                'hasSubmenu' => false,
            ],
            (object)[
                'title' => 'Service Requests',
                'icon' => 'ti ti-inbox',
                'url' => route('admin.service-requests'),
                'hasSubmenu' => false,

            ],
            (object)[
                'title' => 'Registrations',
                'icon' => 'ti ti-clipboard-list',
                'url' => route('admin.registrations'),
                'hasSubmenu' => false,

            ],
            (object)[
                'title' => 'Case Study',
                'icon' => 'ti ti-briefcase',
                'url' => '#',
                'hasSubmenu' => true,
                'submenu' => [
                    (object)['title' => 'Case Categories', 'url' => route('admin.casecategories')],
                    (object)['title' => 'Case Studies', 'url' => route('admin.case-studies')],
                ],
            ],
            (object)[
                'title' => 'Blogs',
                'icon' => 'ti ti-article',
                'url' => '#',
                'hasSubmenu' => true,
                'submenu' => [
                    (object)['title' => 'Categories', 'url' => route('admin.categories')],
                    (object)['title' => 'Blogs', 'url' => route('admin.blogs')],
                ],
            ],
            (object)[
                'title' => 'Testimonials',
                'icon' => 'ti ti-star',
                'url' => route('admin.testimonials'),
                'hasSubmenu' => false,

            ],
            (object)[
                'title' => 'Faq',
                'icon' => 'ti ti-help-circle',
                'url' => route('admin.faq'),
                'hasSubmenu' => false,

            ],
            (object)[
                'title' => 'Contacts',
                'icon' => 'ti ti-mail',
                'url' => route('admin.contacts'),
                'hasSubmenu' => false,

            ],
            (object)[
                'title' => 'Settings',
                'icon' => 'ti ti-settings',
                'url' => route('admin.settings'),
                'hasSubmenu' => false,

            ],
        ]);
        return $menu;
    }
}
