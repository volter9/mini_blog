<?php

$path = module_path('landing', 'actions');

route('GET #admin_landing /admin/landing/', "$path/index");
route('GET #index /', "$path/landing");