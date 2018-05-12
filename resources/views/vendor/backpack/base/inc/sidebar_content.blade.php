<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<?php if (Gate::allows('admin')): ?>
<li>
    <a href="{{ backpack_url('dashboard') }}">
        <i class="fa fa-dashboard"></i>
        <span>{{ trans('backpack::base.dashboard') }}</span>
    </a>
</li>

<li>
    <a href="{{ backpack_url('championship') }}">
        <i class="fa fa-user-circle"></i>
        <span>{{ trans('interface.menu.championships') }}</span>
    </a>
</li>

<li>
    <a href="{{ backpack_url('game') }}">
        <i class="fa fa-gamepad"></i>
        <span>{{ trans('interface.menu.games') }}</span>
    </a>
</li>

<li>
    <a href="{{ backpack_url('gamer') }}">
        <i class="fa fa-user-times"></i>
        <span>{{ trans('interface.menu.gamers') }}</span>
    </a>
</li>


<li>
    <a href="{{ backpack_url('command') }}">
        <i class="fa fa-user-times"></i>
        <span>{{ trans('interface.menu.commands') }}</span>
    </a>
</li>

<li>
    <a href="{{ backpack_url('round') }}">
        <i class="fa fa-shekel"></i>
        <span>{{ trans('interface.menu.rounds') }}</span>
    </a>
</li>

<li>
    <a href="{{ backpack_url('question') }}">
        <i class="fa fa-question"></i>
        <span>{{ trans('interface.menu.questions') }}</span>
    </a>
</li>
<?php endif; ?>
<li>
    <a href="{{ backpack_url('user') }}">
        <i class="fa fa-user"></i>
        <span>{{ trans('interface.menu.users') }}</span>
    </a>
</li>