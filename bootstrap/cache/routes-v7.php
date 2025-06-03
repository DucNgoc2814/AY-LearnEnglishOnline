<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/health-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.healthCheck',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/execute-solution' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.executeSolution',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/update-config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.updateConfig',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9eCgayghCkoQdS9E',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/apply-coupon' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::H9bubxTUwDNECfoQ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/payment/check-expiry' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.payment.check-expiry',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.login.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/users/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/classes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.classes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.classes.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/classes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.classes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/courses' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.courses.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.courses.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/courses/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.courses.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/video-lessons' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-lessons.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-lessons.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/zoom-sessions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.zoom-sessions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.zoom-sessions.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/categories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.categories.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.categories.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/categories/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.categories.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/tests' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tests.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tests.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/tests/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tests.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/questions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.questions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.questions.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/questions/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.questions.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dictations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dictations.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dictations.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dictations/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dictations.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/lessons' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.lessons.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.lessons.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/lessons/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.lessons.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/blogs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.blogs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.blogs.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/blogs/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.blogs.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/orders' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.orders.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.orders.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/orders/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.orders.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vouchers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vouchers.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vouchers.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/students' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.students.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.students.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/banners' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.banners.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.banners.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/employees' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.employees.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.employees.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/employees/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.employees.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/video-exercise-lessons' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-exercise-lessons.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-exercise-lessons.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/video-exercise-lessons/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-exercise-lessons.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-videos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-videos.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-videos.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-videos/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-videos.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-quizlets' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-quizlets.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-quizlets.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-quizlets/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-quizlets.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-dictations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-dictations.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-dictations.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-dictations/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-dictations.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-key-phrases' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-key-phrases.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-key-phrases.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-key-phrases/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-key-phrases.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-sentence-buildings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-sentence-buildings.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-sentence-buildings.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-sentence-buildings/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-sentence-buildings.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-grammars' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-grammars.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-grammars.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-grammars/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-grammars.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-transcriptions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-transcriptions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-transcriptions.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-transcriptions/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-transcriptions.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-ending-sounds' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-ending-sounds.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-ending-sounds.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/vocabulary-listening-ending-sounds/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-ending-sounds.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/video-handout-units' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-units.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-units.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/video-handout-units/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-units.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/video-handout-lessons' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-lessons.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-lessons.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/video-handout-lessons/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-lessons.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/video-handout-files' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-files.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-files.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/video-handout-files/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-files.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/video-shadowings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowings.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowings.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/video-shadowings/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowings.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/video-shadowing-segments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowing-segments.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowing-segments.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/video-shadowing-segments/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowing-segments.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/reflection-exercises' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercises.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercises.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/reflection-exercises/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercises.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/reflection-sentence-structures' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-sentence-structures.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-sentence-structures.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/reflection-sentence-structures/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-sentence-structures.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/reflection-exercise-questions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercise-questions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercise-questions.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/reflection-exercise-questions/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercise-questions.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/class-students' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.class-students.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.class-students.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/class-students/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.class-students.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/course-registrations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.course-registrations.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.course-registrations.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/course-registrations/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.course-registrations.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/trang-chu' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'client.home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dang-ky' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'register.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dang-nhap' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'login.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/check-auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'check.auth',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/session-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'session.status',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/schedule-logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'schedule.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cancel-logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cancel.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/debug-schedule' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debug.schedule',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dang-xuat' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/thanh-toan' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'checkout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tai-khoan' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'profile.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tai-khoan/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'profile.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/comments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'client.comments.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ratings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'client.ratings.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/thi-thu-toeic' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'practice-tests.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/news' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.news.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/clear-cache' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'clear.cache',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/clear-view' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'clear.view',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/clear-config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'clear.config',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/clear-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'clear.all',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dictionary' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dictionary.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/exercises/dictation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'exercises.dictation.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/exercises/video-dubbing' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'exercises.video-dubbing.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/exercises/progress/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'exercises.progress.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/oxford/process-text' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YdExXcjjCUa0zdnJ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/oxford/word-info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5jfjfpLMFStSD396',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/video-handout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'video-handout.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/video-shadowing' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'video-shadowing.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/vocabulary-listening' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'vocabulary-listening.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/auth/facebook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'auth.facebook',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/auth/facebook/callback' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'auth.facebook.callback',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'online.login.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/auth/google' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.auth.google',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/auth/google/callback' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.auth.google.callback',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/classes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.classes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/sessions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.sessions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/schedule' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.schedule',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/tests' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.tests.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/grades' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.grades.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/teacher/schedule' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.schedule',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/teacher/classes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.classes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/teacher/grades' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.grades.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/teacher/grades/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.grades.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/attendance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.attendance.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/awards' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.awards.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/guides' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.guides.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/support' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.support.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/support/ticket' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.support.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/online/ebooks' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.ebooks.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/a(?|pi/table\\-columns/([^/]++)(*:38)|dmin/(?|users/([^/]++)(?|(*:70)|/edit(*:82)|(*:89))|c(?|lass(?|es/([^/]++)(?|/(?|edit(*:130)|restore(*:145))|(*:154))|\\-students/(?|([^/]++)(?|/(?|edit(*:196)|restore(*:211))|(*:220))|get\\-students(*:242)))|ourse(?|s/([^/]++)(?|/(?|edit(*:281)|restore(*:296))|(*:305))|\\-registrations/([^/]++)(?|/(?|edit(*:349)|restore(*:364))|(*:373)))|ategories/([^/]++)(?|/(?|edit(*:412)|restore(*:427))|(*:436)))|v(?|ideo\\-(?|lessons/([^/]++)(?|/(?|edit(*:486)|restore(*:501))|(*:510))|exercise\\-lessons/([^/]++)(?|/(?|edit(*:556)|restore(*:571))|(*:580))|handout\\-(?|units/([^/]++)(?|/(?|edit(*:626)|restore(*:641))|(*:650))|lessons/([^/]++)(?|/(?|edit(*:686)|restore(*:701))|(*:710))|files/([^/]++)(?|/(?|edit(*:744)|restore(*:759))|(*:768)))|shadowing(?|s/([^/]++)(?|/(?|edit(*:811)|restore(*:826))|(*:835))|\\-segments/([^/]++)(?|/(?|edit(*:874)|restore(*:889))|(*:898))))|o(?|uchers/([^/]++)(?|/(?|edit(*:939)|restore(*:954))|(*:963))|cabulary\\-listening\\-(?|videos/([^/]++)(?|/(?|edit(*:1022)|restore(*:1038))|(*:1048))|quizlets/([^/]++)(?|/(?|edit(*:1086)|restore(*:1102))|(*:1112))|dictations/([^/]++)(?|/(?|edit(*:1152)|restore(*:1168))|(*:1178))|key\\-phrases/([^/]++)(?|/(?|edit(*:1220)|restore(*:1236))|(*:1246))|sentence\\-buildings/([^/]++)(?|/(?|edit(*:1295)|restore(*:1311))|(*:1321))|grammars/([^/]++)(?|/(?|edit(*:1359)|restore(*:1375))|(*:1385))|transcriptions/([^/]++)(?|/(?|edit(*:1429)|restore(*:1445))|(*:1455))|ending\\-sounds/([^/]++)(?|/(?|edit(*:1499)|restore(*:1515))|(*:1525)))))|zoom\\-sessions/([^/]++)(?|/(?|edit(*:1572)|restore(*:1588))|(*:1598))|tests/([^/]++)(?|/(?|edit(*:1633)|restore(*:1649))|(*:1659))|questions/([^/]++)(?|/(?|edit(*:1698)|restore(*:1714))|(*:1724))|dictations/([^/]++)(?|/(?|edit(*:1764)|restore(*:1780))|(*:1790))|lessons/([^/]++)(?|/(?|edit(*:1827)|restore(*:1843))|(*:1853))|b(?|logs/([^/]++)(?|(*:1883)|/edit(*:1897)|(*:1906))|anners/([^/]++)(?|/(?|edit(*:1942)|restore(*:1958))|(*:1968)))|orders/(?|([^/]++)(?|(*:2000)|/(?|edit(*:2017)|approve(*:2033)|reject(*:2048))|(*:2058))|export(*:2074))|students/([^/]++)(?|/(?|edit(*:2112)|restore(*:2128))|(*:2138))|employees/([^/]++)(?|(*:2169)|/edit(*:2183)|(*:2192))|reflection\\-(?|exercise(?|s/([^/]++)(?|/(?|edit(*:2249)|restore(*:2265))|(*:2275))|\\-questions/([^/]++)(?|/(?|edit(*:2316)|restore(*:2332))|(*:2342)))|sentence\\-structures/([^/]++)(?|/(?|edit(*:2393)|restore(*:2409))|(*:2419)))))|/stream\\-video/([^/]++)(*:2455)|/d(?|irect\\-video/([^/]++)(*:2490)|anh\\-muc(?:/([^/]++))?(*:2521))|/video\\-(?|proxy/([^/]++)(*:2556)|exercise/([^/]++)(*:2582))|/khoa\\-hoc/([^/]++)(*:2611)|/t(?|hanh\\-toan/(?|([^/]++)(*:2647)|expired(*:2663)|check\\-expiry(*:2685))|est/([^/]++)/(?|submit(*:2717)|retry(*:2731)))|/hoc\\-khoa\\-hoc/([^/]++)(?|(*:2769)|/bai\\-hoc/([^/]++)/(?|video/([^/]++)(*:2814)|bai\\-kiem\\-tra/([^/]++)(*:2846)))|/co(?|mments/([^/]++)/reply(*:2884)|urses/([^/]++)/comments(*:2916))|/lessons/([^/]++)/([^/]++)(*:2952)|/online/(?|news/([^/]++)(*:2985)|e(?|xercises/(?|video(?|/([^/]++)(?|(*:3030)|/submit(*:3046))|\\-series/([^/]++)(*:3073))|audio(?|/([^/]++)(?|(*:3103)|/submit(*:3119))|\\-collection/([^/]++)(*:3150))|g(?|rammar/([^/]++)(?|(*:3182)|/submit(*:3198))|ames/([^/]++)(*:3221)))|books/([^/]++)(*:3246))|classes/(?|([^/]++)(?|(*:3278)|/tests(*:3293))|quiz/([^/]++)(*:3316))|sessions/([^/]++)(?|(*:3346)|/join(*:3360))|te(?|sts/([^/]++)(?|(*:3390)|/(?|submit(*:3409)|result(*:3424)))|acher/(?|classes/(?|([^/]++)(?|(*:3466)|/(?|attendance(*:3489)|progress/(?|v(?|ideo\\-exercise(*:3528)|ocabulary(*:3546))|handout(*:3563)|shadowing(*:3581)|reflection(*:3600))|materials/upload(*:3626)))|materials/([^/]++)(*:3655))|grades/(?|class/([^/]++)(*:3689)|student/([^/]++)(*:3714)|assessment/([^/]++)(*:3742)|export/([^/]++)(*:3766))))|g(?|rades/(?|([^/]++)(*:3799)|detail/([^/]++)(*:3823))|uides/([^/]++)(*:3847))|a(?|ttendance/(?|detail/([^/]++)(*:3889)|s(?|ave/([^/]++)(*:3914)|essions/([^/]++)(*:3939))|([^/]++)(*:3957))|wards/([^/]++)(*:3981)))|/exercises/(?|dictation/(?|([^/]++)(*:4027)|check(*:4041)|([^/]++)/script(*:4065))|video\\-dubbing/([^/]++)(*:4098))|/reflection\\-exercise/([^/]++)(*:4138))/?$}sDu',
    ),
    3 => 
    array (
      38 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CdVXzuUTSUcUrYbc',
          ),
          1 => 
          array (
            0 => 'tableId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      70 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.show',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      82 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.edit',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      89 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.update',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.destroy',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      130 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.classes.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      145 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.classes.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      154 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.classes.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.classes.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      196 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.class-students.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      211 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.class-students.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      220 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.class-students.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.class-students.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      242 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.class-students.get-students',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      281 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.courses.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      296 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.courses.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      305 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.courses.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.courses.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      349 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.course-registrations.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      364 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.course-registrations.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      373 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.course-registrations.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.course-registrations.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      412 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.categories.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      427 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.categories.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      436 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.categories.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.categories.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      486 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-lessons.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      501 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-lessons.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      510 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-lessons.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-lessons.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      556 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-exercise-lessons.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      571 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-exercise-lessons.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      580 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-exercise-lessons.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-exercise-lessons.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      626 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-units.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      641 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-units.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      650 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-units.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-units.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      686 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-lessons.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      701 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-lessons.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      710 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-lessons.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-lessons.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      744 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-files.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      759 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-files.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      768 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-files.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-handout-files.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      811 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowings.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      826 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowings.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      835 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowings.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowings.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      874 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowing-segments.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      889 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowing-segments.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      898 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowing-segments.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.video-shadowing-segments.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      939 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vouchers.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      954 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vouchers.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      963 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vouchers.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vouchers.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1022 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-videos.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1038 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-videos.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1048 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-videos.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-videos.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1086 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-quizlets.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1102 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-quizlets.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1112 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-quizlets.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-quizlets.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1152 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-dictations.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1168 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-dictations.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1178 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-dictations.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-dictations.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1220 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-key-phrases.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1236 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-key-phrases.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1246 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-key-phrases.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-key-phrases.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1295 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-sentence-buildings.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1311 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-sentence-buildings.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1321 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-sentence-buildings.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-sentence-buildings.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1359 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-grammars.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1375 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-grammars.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1385 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-grammars.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-grammars.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1429 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-transcriptions.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1445 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-transcriptions.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1455 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-transcriptions.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-transcriptions.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1499 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-ending-sounds.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1515 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-ending-sounds.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1525 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-ending-sounds.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vocabulary-listening-ending-sounds.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1572 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.zoom-sessions.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1588 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.zoom-sessions.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1598 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.zoom-sessions.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.zoom-sessions.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1633 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tests.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1649 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tests.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1659 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tests.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tests.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1698 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.questions.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1714 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.questions.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1724 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.questions.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.questions.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1764 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dictations.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1780 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dictations.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1790 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dictations.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dictations.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1827 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.lessons.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1843 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.lessons.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1853 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.lessons.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.lessons.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1883 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.blogs.show',
          ),
          1 => 
          array (
            0 => 'blog',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1897 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.blogs.edit',
          ),
          1 => 
          array (
            0 => 'blog',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1906 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.blogs.update',
          ),
          1 => 
          array (
            0 => 'blog',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.blogs.destroy',
          ),
          1 => 
          array (
            0 => 'blog',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1942 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.banners.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1958 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.banners.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1968 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.banners.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.banners.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2000 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.orders.show',
          ),
          1 => 
          array (
            0 => 'order',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2017 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.orders.edit',
          ),
          1 => 
          array (
            0 => 'order',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2033 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.orders.approve',
          ),
          1 => 
          array (
            0 => 'order',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2048 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.orders.reject',
          ),
          1 => 
          array (
            0 => 'order',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2058 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.orders.update',
          ),
          1 => 
          array (
            0 => 'order',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.orders.destroy',
          ),
          1 => 
          array (
            0 => 'order',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2074 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.orders.export',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2112 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.students.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2128 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.students.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2138 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.students.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.students.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2169 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.employees.show',
          ),
          1 => 
          array (
            0 => 'employee',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2183 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.employees.edit',
          ),
          1 => 
          array (
            0 => 'employee',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2192 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.employees.update',
          ),
          1 => 
          array (
            0 => 'employee',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.employees.destroy',
          ),
          1 => 
          array (
            0 => 'employee',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2249 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercises.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2265 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercises.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2275 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercises.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercises.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2316 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercise-questions.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2332 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercise-questions.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2342 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercise-questions.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-exercise-questions.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2393 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-sentence-structures.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2409 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-sentence-structures.restore',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2419 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-sentence-structures.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reflection-sentence-structures.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2455 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'stream.video',
          ),
          1 => 
          array (
            0 => 'videoId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2490 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'direct.video',
          ),
          1 => 
          array (
            0 => 'videoId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2521 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'category.index',
            'slug' => NULL,
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2556 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'video.proxy',
          ),
          1 => 
          array (
            0 => 'videoId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2582 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'video-exercise.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2611 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'detailCourse',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2647 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'payment.qr',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2663 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'payment.expired',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2685 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'payment.check-expiry',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2717 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'test.submit',
          ),
          1 => 
          array (
            0 => 'test',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2731 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'test.retry',
          ),
          1 => 
          array (
            0 => 'test',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2769 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'course.learning',
          ),
          1 => 
          array (
            0 => 'courseSlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2814 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'course.learning.video',
          ),
          1 => 
          array (
            0 => 'courseSlug',
            1 => 'lessonSlug',
            2 => 'videoSlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2846 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'course.learning.test',
          ),
          1 => 
          array (
            0 => 'courseSlug',
            1 => 'lessonSlug',
            2 => 'testSlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2884 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'client.comments.reply',
          ),
          1 => 
          array (
            0 => 'comment',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2916 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'client.courses.comments',
          ),
          1 => 
          array (
            0 => 'courseId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2952 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'lessons.view',
          ),
          1 => 
          array (
            0 => 'lessonId',
            1 => 'enrollmentId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2985 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.news.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3030 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.exercises.video',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3046 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.exercises.video.submit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3073 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.exercises.video-series',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3103 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.exercises.audio',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3119 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.exercises.audio.submit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3150 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.exercises.audio-collection',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3182 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.exercises.grammar',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3198 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.exercises.grammar.submit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3221 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.exercises.games',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3246 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.ebooks.show',
          ),
          1 => 
          array (
            0 => 'ebook',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3278 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.classes.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3293 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.classes.tests',
          ),
          1 => 
          array (
            0 => 'class_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3316 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.classes.quiz',
          ),
          1 => 
          array (
            0 => 'quiz',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3346 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.sessions.show',
          ),
          1 => 
          array (
            0 => 'session',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3360 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.sessions.join',
          ),
          1 => 
          array (
            0 => 'session',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3390 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.tests.show',
          ),
          1 => 
          array (
            0 => 'test_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3409 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.tests.submit',
          ),
          1 => 
          array (
            0 => 'test_id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3424 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.tests.result',
          ),
          1 => 
          array (
            0 => 'test_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3466 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.classes.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3489 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.classes.attendance',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3528 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.classes.progress.video-exercise',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3546 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.classes.progress.vocabulary',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3563 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.classes.progress.handout',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3581 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.classes.progress.shadowing',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3600 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.classes.progress.reflection',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3626 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.classes.materials.upload',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3655 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.classes.materials.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3689 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.grades.class',
          ),
          1 => 
          array (
            0 => 'class_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3714 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.grades.student',
          ),
          1 => 
          array (
            0 => 'student_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3742 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.grades.assessment',
          ),
          1 => 
          array (
            0 => 'assessment_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3766 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.teacher.grades.export',
          ),
          1 => 
          array (
            0 => 'class_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3799 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.grades.show',
          ),
          1 => 
          array (
            0 => 'class_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3823 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.grades.detail',
          ),
          1 => 
          array (
            0 => 'assessment_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3847 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.guides.show',
          ),
          1 => 
          array (
            0 => 'topic',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3889 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.attendance.detail',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3914 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.attendance.save',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3939 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.attendance.sessions',
          ),
          1 => 
          array (
            0 => 'class',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3957 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.attendance.show',
          ),
          1 => 
          array (
            0 => 'class',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3981 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'online.awards.show',
          ),
          1 => 
          array (
            0 => 'award',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4027 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'exercises.dictation',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4041 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dictation.check',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4065 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dictation.script',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4098 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'exercises.video-dubbing.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4138 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reflection-exercise.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.healthCheck' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_ignition/health-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController',
        'as' => 'ignition.healthCheck',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.executeSolution' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/execute-solution',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController',
        'as' => 'ignition.executeSolution',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.updateConfig' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/update-config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController',
        'as' => 'ignition.updateConfig',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9eCgayghCkoQdS9E' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:77:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000009420000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::9eCgayghCkoQdS9E',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::H9bubxTUwDNECfoQ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/apply-coupon',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\VoucherController@applyCoupon',
        'controller' => 'App\\Http\\Controllers\\Client\\VoucherController@applyCoupon',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::H9bubxTUwDNECfoQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.payment.check-expiry' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/payment/check-expiry',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\PaymentController@checkPaymentExpiry',
        'controller' => 'App\\Http\\Controllers\\Client\\PaymentController@checkPaymentExpiry',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'api.payment.check-expiry',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CdVXzuUTSUcUrYbc' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/table-columns/{tableId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:119:"function ($tableId) {
    $columns = \\config("table-columns.{$tableId}", []);
    return \\response()->json($columns);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000009450000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::CdVXzuUTSUcUrYbc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest:employee',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AuthController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Admin\\AuthController@showLoginForm',
        'as' => 'admin.login',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.login.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest:employee',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AuthController@login',
        'controller' => 'App\\Http\\Controllers\\Admin\\AuthController@login',
        'as' => 'admin.login.post',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AuthController@logout',
        'controller' => 'App\\Http\\Controllers\\Admin\\AuthController@logout',
        'as' => 'admin.logout',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DashboardController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\DashboardController@index',
        'as' => 'admin.dashboard',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@index',
        'as' => 'admin.users.index',
        'namespace' => NULL,
        'prefix' => 'admin/users',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@create',
        'as' => 'admin.users.create',
        'namespace' => NULL,
        'prefix' => 'admin/users',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@store',
        'as' => 'admin.users.store',
        'namespace' => NULL,
        'prefix' => 'admin/users',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@show',
        'as' => 'admin.users.show',
        'namespace' => NULL,
        'prefix' => 'admin/users',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/{user}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@edit',
        'as' => 'admin.users.edit',
        'namespace' => NULL,
        'prefix' => 'admin/users',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@update',
        'as' => 'admin.users.update',
        'namespace' => NULL,
        'prefix' => 'admin/users',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@destroy',
        'as' => 'admin.users.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/users',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.classes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/classes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassController@index',
        'as' => 'admin.classes.index',
        'namespace' => NULL,
        'prefix' => 'admin/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.classes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/classes/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassController@create',
        'as' => 'admin.classes.create',
        'namespace' => NULL,
        'prefix' => 'admin/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.classes.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/classes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassController@store',
        'as' => 'admin.classes.store',
        'namespace' => NULL,
        'prefix' => 'admin/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.classes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/classes/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassController@edit',
        'as' => 'admin.classes.edit',
        'namespace' => NULL,
        'prefix' => 'admin/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.classes.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/classes/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassController@update',
        'as' => 'admin.classes.update',
        'namespace' => NULL,
        'prefix' => 'admin/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.classes.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/classes/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassController@destroy',
        'as' => 'admin.classes.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.classes.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/classes/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassController@restore',
        'as' => 'admin.classes.restore',
        'namespace' => NULL,
        'prefix' => 'admin/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.courses.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/courses',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@index',
        'as' => 'admin.courses.index',
        'namespace' => NULL,
        'prefix' => 'admin/courses',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.courses.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/courses/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@create',
        'as' => 'admin.courses.create',
        'namespace' => NULL,
        'prefix' => 'admin/courses',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.courses.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/courses',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@store',
        'as' => 'admin.courses.store',
        'namespace' => NULL,
        'prefix' => 'admin/courses',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.courses.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/courses/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@edit',
        'as' => 'admin.courses.edit',
        'namespace' => NULL,
        'prefix' => 'admin/courses',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.courses.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/courses/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@update',
        'as' => 'admin.courses.update',
        'namespace' => NULL,
        'prefix' => 'admin/courses',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.courses.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/courses/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@destroy',
        'as' => 'admin.courses.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/courses',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.courses.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/courses/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@restore',
        'as' => 'admin.courses.restore',
        'namespace' => NULL,
        'prefix' => 'admin/courses',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-lessons.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-lessons',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoLessonController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoLessonController@index',
        'as' => 'admin.video-lessons.index',
        'namespace' => NULL,
        'prefix' => 'admin/video-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-lessons.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/video-lessons',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoLessonController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoLessonController@store',
        'as' => 'admin.video-lessons.store',
        'namespace' => NULL,
        'prefix' => 'admin/video-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-lessons.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-lessons/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoLessonController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoLessonController@edit',
        'as' => 'admin.video-lessons.edit',
        'namespace' => NULL,
        'prefix' => 'admin/video-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-lessons.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/video-lessons/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoLessonController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoLessonController@update',
        'as' => 'admin.video-lessons.update',
        'namespace' => NULL,
        'prefix' => 'admin/video-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-lessons.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/video-lessons/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoLessonController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoLessonController@destroy',
        'as' => 'admin.video-lessons.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/video-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-lessons.restore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/video-lessons/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoLessonController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoLessonController@restore',
        'as' => 'admin.video-lessons.restore',
        'namespace' => NULL,
        'prefix' => 'admin/video-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.zoom-sessions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/zoom-sessions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ZoomSessionController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ZoomSessionController@index',
        'as' => 'admin.zoom-sessions.index',
        'namespace' => NULL,
        'prefix' => 'admin/zoom-sessions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.zoom-sessions.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/zoom-sessions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ZoomSessionController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\ZoomSessionController@store',
        'as' => 'admin.zoom-sessions.store',
        'namespace' => NULL,
        'prefix' => 'admin/zoom-sessions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.zoom-sessions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/zoom-sessions/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ZoomSessionController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\ZoomSessionController@edit',
        'as' => 'admin.zoom-sessions.edit',
        'namespace' => NULL,
        'prefix' => 'admin/zoom-sessions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.zoom-sessions.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/zoom-sessions/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ZoomSessionController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\ZoomSessionController@update',
        'as' => 'admin.zoom-sessions.update',
        'namespace' => NULL,
        'prefix' => 'admin/zoom-sessions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.zoom-sessions.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/zoom-sessions/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ZoomSessionController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\ZoomSessionController@destroy',
        'as' => 'admin.zoom-sessions.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/zoom-sessions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.zoom-sessions.restore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/zoom-sessions/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ZoomSessionController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\ZoomSessionController@restore',
        'as' => 'admin.zoom-sessions.restore',
        'namespace' => NULL,
        'prefix' => 'admin/zoom-sessions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.categories.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@index',
        'as' => 'admin.categories.index',
        'namespace' => NULL,
        'prefix' => 'admin/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.categories.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/categories/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@create',
        'as' => 'admin.categories.create',
        'namespace' => NULL,
        'prefix' => 'admin/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.categories.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@store',
        'as' => 'admin.categories.store',
        'namespace' => NULL,
        'prefix' => 'admin/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.categories.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/categories/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@edit',
        'as' => 'admin.categories.edit',
        'namespace' => NULL,
        'prefix' => 'admin/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.categories.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/categories/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@update',
        'as' => 'admin.categories.update',
        'namespace' => NULL,
        'prefix' => 'admin/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.categories.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/categories/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@destroy',
        'as' => 'admin.categories.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.categories.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/categories/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@restore',
        'as' => 'admin.categories.restore',
        'namespace' => NULL,
        'prefix' => 'admin/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tests.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/tests',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TestController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\TestController@index',
        'as' => 'admin.tests.index',
        'namespace' => NULL,
        'prefix' => 'admin/tests',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tests.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/tests/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TestController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\TestController@create',
        'as' => 'admin.tests.create',
        'namespace' => NULL,
        'prefix' => 'admin/tests',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tests.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/tests',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TestController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\TestController@store',
        'as' => 'admin.tests.store',
        'namespace' => NULL,
        'prefix' => 'admin/tests',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tests.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/tests/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TestController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\TestController@edit',
        'as' => 'admin.tests.edit',
        'namespace' => NULL,
        'prefix' => 'admin/tests',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tests.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/tests/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TestController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\TestController@update',
        'as' => 'admin.tests.update',
        'namespace' => NULL,
        'prefix' => 'admin/tests',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tests.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/tests/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TestController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\TestController@destroy',
        'as' => 'admin.tests.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/tests',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tests.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/tests/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TestController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\TestController@restore',
        'as' => 'admin.tests.restore',
        'namespace' => NULL,
        'prefix' => 'admin/tests',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.questions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/questions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QuestionController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\QuestionController@index',
        'as' => 'admin.questions.index',
        'namespace' => NULL,
        'prefix' => 'admin/questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.questions.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/questions/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QuestionController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\QuestionController@create',
        'as' => 'admin.questions.create',
        'namespace' => NULL,
        'prefix' => 'admin/questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.questions.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/questions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QuestionController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\QuestionController@store',
        'as' => 'admin.questions.store',
        'namespace' => NULL,
        'prefix' => 'admin/questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.questions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/questions/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QuestionController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\QuestionController@edit',
        'as' => 'admin.questions.edit',
        'namespace' => NULL,
        'prefix' => 'admin/questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.questions.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/questions/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QuestionController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\QuestionController@update',
        'as' => 'admin.questions.update',
        'namespace' => NULL,
        'prefix' => 'admin/questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.questions.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/questions/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QuestionController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\QuestionController@destroy',
        'as' => 'admin.questions.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.questions.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/questions/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QuestionController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\QuestionController@restore',
        'as' => 'admin.questions.restore',
        'namespace' => NULL,
        'prefix' => 'admin/questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dictations.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dictations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DictationController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\DictationController@index',
        'as' => 'admin.dictations.index',
        'namespace' => NULL,
        'prefix' => 'admin/dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dictations.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dictations/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DictationController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\DictationController@create',
        'as' => 'admin.dictations.create',
        'namespace' => NULL,
        'prefix' => 'admin/dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dictations.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/dictations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DictationController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\DictationController@store',
        'as' => 'admin.dictations.store',
        'namespace' => NULL,
        'prefix' => 'admin/dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dictations.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dictations/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DictationController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\DictationController@edit',
        'as' => 'admin.dictations.edit',
        'namespace' => NULL,
        'prefix' => 'admin/dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dictations.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/dictations/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DictationController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\DictationController@update',
        'as' => 'admin.dictations.update',
        'namespace' => NULL,
        'prefix' => 'admin/dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dictations.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/dictations/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DictationController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\DictationController@destroy',
        'as' => 'admin.dictations.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dictations.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/dictations/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DictationController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\DictationController@restore',
        'as' => 'admin.dictations.restore',
        'namespace' => NULL,
        'prefix' => 'admin/dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.lessons.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/lessons',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\LessonController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\LessonController@index',
        'as' => 'admin.lessons.index',
        'namespace' => NULL,
        'prefix' => 'admin/lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.lessons.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/lessons/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\LessonController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\LessonController@create',
        'as' => 'admin.lessons.create',
        'namespace' => NULL,
        'prefix' => 'admin/lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.lessons.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/lessons',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\LessonController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\LessonController@store',
        'as' => 'admin.lessons.store',
        'namespace' => NULL,
        'prefix' => 'admin/lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.lessons.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/lessons/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\LessonController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\LessonController@edit',
        'as' => 'admin.lessons.edit',
        'namespace' => NULL,
        'prefix' => 'admin/lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.lessons.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/lessons/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\LessonController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\LessonController@update',
        'as' => 'admin.lessons.update',
        'namespace' => NULL,
        'prefix' => 'admin/lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.lessons.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/lessons/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\LessonController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\LessonController@destroy',
        'as' => 'admin.lessons.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.lessons.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/lessons/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\LessonController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\LessonController@restore',
        'as' => 'admin.lessons.restore',
        'namespace' => NULL,
        'prefix' => 'admin/lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.blogs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/blogs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogController@index',
        'as' => 'admin.blogs.index',
        'namespace' => NULL,
        'prefix' => 'admin/blogs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.blogs.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/blogs/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogController@create',
        'as' => 'admin.blogs.create',
        'namespace' => NULL,
        'prefix' => 'admin/blogs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.blogs.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/blogs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogController@store',
        'as' => 'admin.blogs.store',
        'namespace' => NULL,
        'prefix' => 'admin/blogs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.blogs.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/blogs/{blog}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogController@show',
        'as' => 'admin.blogs.show',
        'namespace' => NULL,
        'prefix' => 'admin/blogs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.blogs.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/blogs/{blog}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogController@edit',
        'as' => 'admin.blogs.edit',
        'namespace' => NULL,
        'prefix' => 'admin/blogs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.blogs.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/blogs/{blog}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogController@update',
        'as' => 'admin.blogs.update',
        'namespace' => NULL,
        'prefix' => 'admin/blogs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.blogs.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/blogs/{blog}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogController@destroy',
        'as' => 'admin.blogs.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/blogs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.orders.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/orders',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\OrderController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\OrderController@index',
        'as' => 'admin.orders.index',
        'namespace' => NULL,
        'prefix' => 'admin/orders',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.orders.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/orders/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\OrderController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\OrderController@create',
        'as' => 'admin.orders.create',
        'namespace' => NULL,
        'prefix' => 'admin/orders',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.orders.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/orders',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\OrderController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\OrderController@store',
        'as' => 'admin.orders.store',
        'namespace' => NULL,
        'prefix' => 'admin/orders',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.orders.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/orders/{order}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\OrderController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\OrderController@show',
        'as' => 'admin.orders.show',
        'namespace' => NULL,
        'prefix' => 'admin/orders',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.orders.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/orders/{order}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\OrderController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\OrderController@edit',
        'as' => 'admin.orders.edit',
        'namespace' => NULL,
        'prefix' => 'admin/orders',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.orders.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/orders/{order}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\OrderController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\OrderController@update',
        'as' => 'admin.orders.update',
        'namespace' => NULL,
        'prefix' => 'admin/orders',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.orders.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/orders/{order}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\OrderController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\OrderController@destroy',
        'as' => 'admin.orders.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/orders',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.orders.approve' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/orders/{order}/approve',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\OrderController@approve',
        'controller' => 'App\\Http\\Controllers\\Admin\\OrderController@approve',
        'as' => 'admin.orders.approve',
        'namespace' => NULL,
        'prefix' => 'admin/orders',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.orders.reject' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/orders/{order}/reject',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\OrderController@reject',
        'controller' => 'App\\Http\\Controllers\\Admin\\OrderController@reject',
        'as' => 'admin.orders.reject',
        'namespace' => NULL,
        'prefix' => 'admin/orders',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.orders.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/orders/export',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\OrderController@export',
        'controller' => 'App\\Http\\Controllers\\Admin\\OrderController@export',
        'as' => 'admin.orders.export',
        'namespace' => NULL,
        'prefix' => 'admin/orders',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vouchers.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vouchers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VoucherController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VoucherController@index',
        'as' => 'admin.vouchers.index',
        'namespace' => NULL,
        'prefix' => 'admin/vouchers',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vouchers.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/vouchers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VoucherController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VoucherController@store',
        'as' => 'admin.vouchers.store',
        'namespace' => NULL,
        'prefix' => 'admin/vouchers',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vouchers.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vouchers/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VoucherController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VoucherController@edit',
        'as' => 'admin.vouchers.edit',
        'namespace' => NULL,
        'prefix' => 'admin/vouchers',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vouchers.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vouchers/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VoucherController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VoucherController@update',
        'as' => 'admin.vouchers.update',
        'namespace' => NULL,
        'prefix' => 'admin/vouchers',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vouchers.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/vouchers/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VoucherController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VoucherController@destroy',
        'as' => 'admin.vouchers.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/vouchers',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vouchers.restore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/vouchers/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VoucherController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VoucherController@restore',
        'as' => 'admin.vouchers.restore',
        'namespace' => NULL,
        'prefix' => 'admin/vouchers',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.students.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/students',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\StudentController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\StudentController@index',
        'as' => 'admin.students.index',
        'namespace' => NULL,
        'prefix' => 'admin/students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.students.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/students',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\StudentController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\StudentController@store',
        'as' => 'admin.students.store',
        'namespace' => NULL,
        'prefix' => 'admin/students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.students.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/students/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\StudentController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\StudentController@edit',
        'as' => 'admin.students.edit',
        'namespace' => NULL,
        'prefix' => 'admin/students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.students.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/students/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\StudentController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\StudentController@update',
        'as' => 'admin.students.update',
        'namespace' => NULL,
        'prefix' => 'admin/students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.students.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/students/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\StudentController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\StudentController@destroy',
        'as' => 'admin.students.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.students.restore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/students/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\StudentController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\StudentController@restore',
        'as' => 'admin.students.restore',
        'namespace' => NULL,
        'prefix' => 'admin/students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.banners.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/banners',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BannerController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\BannerController@index',
        'as' => 'admin.banners.index',
        'namespace' => NULL,
        'prefix' => 'admin/banners',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.banners.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/banners',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BannerController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\BannerController@store',
        'as' => 'admin.banners.store',
        'namespace' => NULL,
        'prefix' => 'admin/banners',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.banners.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/banners/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BannerController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\BannerController@edit',
        'as' => 'admin.banners.edit',
        'namespace' => NULL,
        'prefix' => 'admin/banners',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.banners.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/banners/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BannerController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\BannerController@update',
        'as' => 'admin.banners.update',
        'namespace' => NULL,
        'prefix' => 'admin/banners',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.banners.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/banners/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BannerController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\BannerController@destroy',
        'as' => 'admin.banners.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/banners',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.banners.restore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/banners/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BannerController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\BannerController@restore',
        'as' => 'admin.banners.restore',
        'namespace' => NULL,
        'prefix' => 'admin/banners',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.employees.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/employees',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'as' => 'admin.employees.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\EmployeeController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\EmployeeController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.employees.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/employees/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'as' => 'admin.employees.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\EmployeeController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\EmployeeController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.employees.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/employees',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'as' => 'admin.employees.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\EmployeeController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\EmployeeController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.employees.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/employees/{employee}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'as' => 'admin.employees.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\EmployeeController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\EmployeeController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.employees.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/employees/{employee}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'as' => 'admin.employees.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\EmployeeController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\EmployeeController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.employees.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/employees/{employee}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'as' => 'admin.employees.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\EmployeeController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\EmployeeController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.employees.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/employees/{employee}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'as' => 'admin.employees.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\EmployeeController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\EmployeeController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-exercise-lessons.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-exercise-lessons',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@index',
        'as' => 'admin.video-exercise-lessons.index',
        'namespace' => NULL,
        'prefix' => 'admin/video-exercise-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-exercise-lessons.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-exercise-lessons/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@create',
        'as' => 'admin.video-exercise-lessons.create',
        'namespace' => NULL,
        'prefix' => 'admin/video-exercise-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-exercise-lessons.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/video-exercise-lessons',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@store',
        'as' => 'admin.video-exercise-lessons.store',
        'namespace' => NULL,
        'prefix' => 'admin/video-exercise-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-exercise-lessons.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-exercise-lessons/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@edit',
        'as' => 'admin.video-exercise-lessons.edit',
        'namespace' => NULL,
        'prefix' => 'admin/video-exercise-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-exercise-lessons.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/video-exercise-lessons/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@update',
        'as' => 'admin.video-exercise-lessons.update',
        'namespace' => NULL,
        'prefix' => 'admin/video-exercise-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-exercise-lessons.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/video-exercise-lessons/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@destroy',
        'as' => 'admin.video-exercise-lessons.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/video-exercise-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-exercise-lessons.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/video-exercise-lessons/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoExerciseLessonController@restore',
        'as' => 'admin.video-exercise-lessons.restore',
        'namespace' => NULL,
        'prefix' => 'admin/video-exercise-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-videos.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-videos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@index',
        'as' => 'admin.vocabulary-listening-videos.index',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-videos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-videos.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-videos/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@create',
        'as' => 'admin.vocabulary-listening-videos.create',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-videos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-videos.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/vocabulary-listening-videos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@store',
        'as' => 'admin.vocabulary-listening-videos.store',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-videos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-videos.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-videos/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@edit',
        'as' => 'admin.vocabulary-listening-videos.edit',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-videos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-videos.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-videos/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@update',
        'as' => 'admin.vocabulary-listening-videos.update',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-videos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-videos.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/vocabulary-listening-videos/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@destroy',
        'as' => 'admin.vocabulary-listening-videos.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-videos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-videos.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-videos/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningVideoController@restore',
        'as' => 'admin.vocabulary-listening-videos.restore',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-videos',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-quizlets.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-quizlets',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@index',
        'as' => 'admin.vocabulary-listening-quizlets.index',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-quizlets',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-quizlets.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-quizlets/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@create',
        'as' => 'admin.vocabulary-listening-quizlets.create',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-quizlets',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-quizlets.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/vocabulary-listening-quizlets',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@store',
        'as' => 'admin.vocabulary-listening-quizlets.store',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-quizlets',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-quizlets.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-quizlets/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@edit',
        'as' => 'admin.vocabulary-listening-quizlets.edit',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-quizlets',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-quizlets.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-quizlets/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@update',
        'as' => 'admin.vocabulary-listening-quizlets.update',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-quizlets',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-quizlets.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/vocabulary-listening-quizlets/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@destroy',
        'as' => 'admin.vocabulary-listening-quizlets.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-quizlets',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-quizlets.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-quizlets/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningQuizletController@restore',
        'as' => 'admin.vocabulary-listening-quizlets.restore',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-quizlets',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-dictations.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-dictations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@index',
        'as' => 'admin.vocabulary-listening-dictations.index',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-dictations.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-dictations/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@create',
        'as' => 'admin.vocabulary-listening-dictations.create',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-dictations.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/vocabulary-listening-dictations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@store',
        'as' => 'admin.vocabulary-listening-dictations.store',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-dictations.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-dictations/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@edit',
        'as' => 'admin.vocabulary-listening-dictations.edit',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-dictations.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-dictations/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@update',
        'as' => 'admin.vocabulary-listening-dictations.update',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-dictations.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/vocabulary-listening-dictations/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@destroy',
        'as' => 'admin.vocabulary-listening-dictations.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-dictations.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-dictations/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningDictationController@restore',
        'as' => 'admin.vocabulary-listening-dictations.restore',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-dictations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-key-phrases.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-key-phrases',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@index',
        'as' => 'admin.vocabulary-listening-key-phrases.index',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-key-phrases',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-key-phrases.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-key-phrases/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@create',
        'as' => 'admin.vocabulary-listening-key-phrases.create',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-key-phrases',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-key-phrases.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/vocabulary-listening-key-phrases',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@store',
        'as' => 'admin.vocabulary-listening-key-phrases.store',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-key-phrases',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-key-phrases.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-key-phrases/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@edit',
        'as' => 'admin.vocabulary-listening-key-phrases.edit',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-key-phrases',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-key-phrases.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-key-phrases/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@update',
        'as' => 'admin.vocabulary-listening-key-phrases.update',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-key-phrases',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-key-phrases.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/vocabulary-listening-key-phrases/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@destroy',
        'as' => 'admin.vocabulary-listening-key-phrases.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-key-phrases',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-key-phrases.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-key-phrases/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningKeyPhraseController@restore',
        'as' => 'admin.vocabulary-listening-key-phrases.restore',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-key-phrases',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-sentence-buildings.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-sentence-buildings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@index',
        'as' => 'admin.vocabulary-listening-sentence-buildings.index',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-sentence-buildings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-sentence-buildings.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-sentence-buildings/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@create',
        'as' => 'admin.vocabulary-listening-sentence-buildings.create',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-sentence-buildings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-sentence-buildings.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/vocabulary-listening-sentence-buildings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@store',
        'as' => 'admin.vocabulary-listening-sentence-buildings.store',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-sentence-buildings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-sentence-buildings.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-sentence-buildings/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@edit',
        'as' => 'admin.vocabulary-listening-sentence-buildings.edit',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-sentence-buildings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-sentence-buildings.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-sentence-buildings/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@update',
        'as' => 'admin.vocabulary-listening-sentence-buildings.update',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-sentence-buildings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-sentence-buildings.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/vocabulary-listening-sentence-buildings/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@destroy',
        'as' => 'admin.vocabulary-listening-sentence-buildings.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-sentence-buildings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-sentence-buildings.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-sentence-buildings/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningSentenceBuildingController@restore',
        'as' => 'admin.vocabulary-listening-sentence-buildings.restore',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-sentence-buildings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-grammars.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-grammars',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@index',
        'as' => 'admin.vocabulary-listening-grammars.index',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-grammars',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-grammars.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-grammars/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@create',
        'as' => 'admin.vocabulary-listening-grammars.create',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-grammars',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-grammars.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/vocabulary-listening-grammars',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@store',
        'as' => 'admin.vocabulary-listening-grammars.store',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-grammars',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-grammars.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-grammars/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@edit',
        'as' => 'admin.vocabulary-listening-grammars.edit',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-grammars',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-grammars.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-grammars/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@update',
        'as' => 'admin.vocabulary-listening-grammars.update',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-grammars',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-grammars.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/vocabulary-listening-grammars/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@destroy',
        'as' => 'admin.vocabulary-listening-grammars.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-grammars',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-grammars.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-grammars/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningGrammarController@restore',
        'as' => 'admin.vocabulary-listening-grammars.restore',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-grammars',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-transcriptions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-transcriptions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@index',
        'as' => 'admin.vocabulary-listening-transcriptions.index',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-transcriptions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-transcriptions.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-transcriptions/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@create',
        'as' => 'admin.vocabulary-listening-transcriptions.create',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-transcriptions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-transcriptions.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/vocabulary-listening-transcriptions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@store',
        'as' => 'admin.vocabulary-listening-transcriptions.store',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-transcriptions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-transcriptions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-transcriptions/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@edit',
        'as' => 'admin.vocabulary-listening-transcriptions.edit',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-transcriptions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-transcriptions.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-transcriptions/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@update',
        'as' => 'admin.vocabulary-listening-transcriptions.update',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-transcriptions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-transcriptions.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/vocabulary-listening-transcriptions/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@destroy',
        'as' => 'admin.vocabulary-listening-transcriptions.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-transcriptions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-transcriptions.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-transcriptions/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningTranscriptionController@restore',
        'as' => 'admin.vocabulary-listening-transcriptions.restore',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-transcriptions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-ending-sounds.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-ending-sounds',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@index',
        'as' => 'admin.vocabulary-listening-ending-sounds.index',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-ending-sounds',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-ending-sounds.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-ending-sounds/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@create',
        'as' => 'admin.vocabulary-listening-ending-sounds.create',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-ending-sounds',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-ending-sounds.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/vocabulary-listening-ending-sounds',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@store',
        'as' => 'admin.vocabulary-listening-ending-sounds.store',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-ending-sounds',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-ending-sounds.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/vocabulary-listening-ending-sounds/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@edit',
        'as' => 'admin.vocabulary-listening-ending-sounds.edit',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-ending-sounds',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-ending-sounds.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-ending-sounds/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@update',
        'as' => 'admin.vocabulary-listening-ending-sounds.update',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-ending-sounds',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-ending-sounds.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/vocabulary-listening-ending-sounds/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@destroy',
        'as' => 'admin.vocabulary-listening-ending-sounds.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-ending-sounds',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vocabulary-listening-ending-sounds.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/vocabulary-listening-ending-sounds/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VocabularyListeningEndingSoundController@restore',
        'as' => 'admin.vocabulary-listening-ending-sounds.restore',
        'namespace' => NULL,
        'prefix' => 'admin/vocabulary-listening-ending-sounds',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-units.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-handout-units',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@index',
        'as' => 'admin.video-handout-units.index',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-units',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-units.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-handout-units/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@create',
        'as' => 'admin.video-handout-units.create',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-units',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-units.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/video-handout-units',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@store',
        'as' => 'admin.video-handout-units.store',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-units',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-units.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-handout-units/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@edit',
        'as' => 'admin.video-handout-units.edit',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-units',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-units.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/video-handout-units/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@update',
        'as' => 'admin.video-handout-units.update',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-units',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-units.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/video-handout-units/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@destroy',
        'as' => 'admin.video-handout-units.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-units',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-units.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/video-handout-units/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutUnitController@restore',
        'as' => 'admin.video-handout-units.restore',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-units',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-lessons.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-handout-lessons',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@index',
        'as' => 'admin.video-handout-lessons.index',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-lessons.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-handout-lessons/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@create',
        'as' => 'admin.video-handout-lessons.create',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-lessons.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/video-handout-lessons',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@store',
        'as' => 'admin.video-handout-lessons.store',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-lessons.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-handout-lessons/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@edit',
        'as' => 'admin.video-handout-lessons.edit',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-lessons.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/video-handout-lessons/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@update',
        'as' => 'admin.video-handout-lessons.update',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-lessons.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/video-handout-lessons/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@destroy',
        'as' => 'admin.video-handout-lessons.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-lessons.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/video-handout-lessons/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutLessonController@restore',
        'as' => 'admin.video-handout-lessons.restore',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-lessons',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-files.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-handout-files',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@index',
        'as' => 'admin.video-handout-files.index',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-files',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-files.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-handout-files/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@create',
        'as' => 'admin.video-handout-files.create',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-files',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-files.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/video-handout-files',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@store',
        'as' => 'admin.video-handout-files.store',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-files',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-files.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-handout-files/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@edit',
        'as' => 'admin.video-handout-files.edit',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-files',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-files.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/video-handout-files/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@update',
        'as' => 'admin.video-handout-files.update',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-files',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-files.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/video-handout-files/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@destroy',
        'as' => 'admin.video-handout-files.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-files',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-handout-files.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/video-handout-files/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoHandoutFileController@restore',
        'as' => 'admin.video-handout-files.restore',
        'namespace' => NULL,
        'prefix' => 'admin/video-handout-files',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowings.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-shadowings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@index',
        'as' => 'admin.video-shadowings.index',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowings.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-shadowings/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@create',
        'as' => 'admin.video-shadowings.create',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowings.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/video-shadowings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@store',
        'as' => 'admin.video-shadowings.store',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowings.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-shadowings/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@edit',
        'as' => 'admin.video-shadowings.edit',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowings.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/video-shadowings/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@update',
        'as' => 'admin.video-shadowings.update',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowings.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/video-shadowings/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@destroy',
        'as' => 'admin.video-shadowings.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowings.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/video-shadowings/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingController@restore',
        'as' => 'admin.video-shadowings.restore',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowing-segments.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-shadowing-segments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@index',
        'as' => 'admin.video-shadowing-segments.index',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowing-segments',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowing-segments.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-shadowing-segments/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@create',
        'as' => 'admin.video-shadowing-segments.create',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowing-segments',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowing-segments.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/video-shadowing-segments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@store',
        'as' => 'admin.video-shadowing-segments.store',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowing-segments',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowing-segments.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/video-shadowing-segments/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@edit',
        'as' => 'admin.video-shadowing-segments.edit',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowing-segments',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowing-segments.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/video-shadowing-segments/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@update',
        'as' => 'admin.video-shadowing-segments.update',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowing-segments',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowing-segments.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/video-shadowing-segments/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@destroy',
        'as' => 'admin.video-shadowing-segments.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowing-segments',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.video-shadowing-segments.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/video-shadowing-segments/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\VideoShadowingSegmentController@restore',
        'as' => 'admin.video-shadowing-segments.restore',
        'namespace' => NULL,
        'prefix' => 'admin/video-shadowing-segments',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercises.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reflection-exercises',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@index',
        'as' => 'admin.reflection-exercises.index',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercises.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reflection-exercises/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@create',
        'as' => 'admin.reflection-exercises.create',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercises.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/reflection-exercises',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@store',
        'as' => 'admin.reflection-exercises.store',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercises.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reflection-exercises/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@edit',
        'as' => 'admin.reflection-exercises.edit',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercises.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/reflection-exercises/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@update',
        'as' => 'admin.reflection-exercises.update',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercises.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/reflection-exercises/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@destroy',
        'as' => 'admin.reflection-exercises.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercises.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/reflection-exercises/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseController@restore',
        'as' => 'admin.reflection-exercises.restore',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-sentence-structures.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reflection-sentence-structures',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@index',
        'as' => 'admin.reflection-sentence-structures.index',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-sentence-structures',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-sentence-structures.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reflection-sentence-structures/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@create',
        'as' => 'admin.reflection-sentence-structures.create',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-sentence-structures',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-sentence-structures.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/reflection-sentence-structures',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@store',
        'as' => 'admin.reflection-sentence-structures.store',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-sentence-structures',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-sentence-structures.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reflection-sentence-structures/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@edit',
        'as' => 'admin.reflection-sentence-structures.edit',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-sentence-structures',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-sentence-structures.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/reflection-sentence-structures/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@update',
        'as' => 'admin.reflection-sentence-structures.update',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-sentence-structures',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-sentence-structures.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/reflection-sentence-structures/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@destroy',
        'as' => 'admin.reflection-sentence-structures.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-sentence-structures',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-sentence-structures.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/reflection-sentence-structures/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionSentenceStructureController@restore',
        'as' => 'admin.reflection-sentence-structures.restore',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-sentence-structures',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercise-questions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reflection-exercise-questions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@index',
        'as' => 'admin.reflection-exercise-questions.index',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercise-questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercise-questions.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reflection-exercise-questions/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@create',
        'as' => 'admin.reflection-exercise-questions.create',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercise-questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercise-questions.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/reflection-exercise-questions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@store',
        'as' => 'admin.reflection-exercise-questions.store',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercise-questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercise-questions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reflection-exercise-questions/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@edit',
        'as' => 'admin.reflection-exercise-questions.edit',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercise-questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercise-questions.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/reflection-exercise-questions/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@update',
        'as' => 'admin.reflection-exercise-questions.update',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercise-questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercise-questions.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/reflection-exercise-questions/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@destroy',
        'as' => 'admin.reflection-exercise-questions.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercise-questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reflection-exercise-questions.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/reflection-exercise-questions/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReflectionExerciseQuestionController@restore',
        'as' => 'admin.reflection-exercise-questions.restore',
        'namespace' => NULL,
        'prefix' => 'admin/reflection-exercise-questions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.class-students.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/class-students',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@index',
        'as' => 'admin.class-students.index',
        'namespace' => NULL,
        'prefix' => 'admin/class-students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.class-students.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/class-students/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@create',
        'as' => 'admin.class-students.create',
        'namespace' => NULL,
        'prefix' => 'admin/class-students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.class-students.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/class-students',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@store',
        'as' => 'admin.class-students.store',
        'namespace' => NULL,
        'prefix' => 'admin/class-students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.class-students.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/class-students/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@edit',
        'as' => 'admin.class-students.edit',
        'namespace' => NULL,
        'prefix' => 'admin/class-students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.class-students.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/class-students/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@update',
        'as' => 'admin.class-students.update',
        'namespace' => NULL,
        'prefix' => 'admin/class-students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.class-students.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/class-students/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@destroy',
        'as' => 'admin.class-students.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/class-students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.class-students.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/class-students/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@restore',
        'as' => 'admin.class-students.restore',
        'namespace' => NULL,
        'prefix' => 'admin/class-students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.class-students.get-students' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/class-students/get-students',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@getStudents',
        'controller' => 'App\\Http\\Controllers\\Admin\\ClassStudentController@getStudents',
        'as' => 'admin.class-students.get-students',
        'namespace' => NULL,
        'prefix' => 'admin/class-students',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.course-registrations.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/course-registrations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@index',
        'as' => 'admin.course-registrations.index',
        'namespace' => NULL,
        'prefix' => 'admin/course-registrations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.course-registrations.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/course-registrations/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@create',
        'as' => 'admin.course-registrations.create',
        'namespace' => NULL,
        'prefix' => 'admin/course-registrations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.course-registrations.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/course-registrations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@store',
        'as' => 'admin.course-registrations.store',
        'namespace' => NULL,
        'prefix' => 'admin/course-registrations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.course-registrations.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/course-registrations/{id}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@edit',
        'as' => 'admin.course-registrations.edit',
        'namespace' => NULL,
        'prefix' => 'admin/course-registrations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.course-registrations.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/course-registrations/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@update',
        'as' => 'admin.course-registrations.update',
        'namespace' => NULL,
        'prefix' => 'admin/course-registrations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.course-registrations.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/course-registrations/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@destroy',
        'as' => 'admin.course-registrations.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/course-registrations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.course-registrations.restore' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/course-registrations/{id}/restore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth:employee',
          2 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@restore',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseRegistrationController@restore',
        'as' => 'admin.course-registrations.restore',
        'namespace' => NULL,
        'prefix' => 'admin/course-registrations',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'stream.video' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'stream-video/{videoId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\CourseController@streamVideo',
        'controller' => 'App\\Http\\Controllers\\Client\\CourseController@streamVideo',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'stream.video',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'direct.video' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'direct-video/{videoId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\CourseController@directVideo',
        'controller' => 'App\\Http\\Controllers\\Client\\CourseController@directVideo',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'direct.video',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\Client\\HomeController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'client.home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'trang-chu',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\Client\\HomeController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'client.home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'video.proxy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'video-proxy/{videoId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\CourseController@videoProxy',
        'controller' => 'App\\Http\\Controllers\\Client\\CourseController@videoProxy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'video.proxy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dang-ky',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'guest',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@showRegisterForm',
        'controller' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@showRegisterForm',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'register.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dang-ky',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'guest',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@register',
        'controller' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@register',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'register.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dang-nhap',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'guest',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@showLoginForm',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dang-nhap',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'guest',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@login',
        'controller' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@login',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'check.auth' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'check-auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@checkAuth',
        'controller' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@checkAuth',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'check.auth',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'session.status' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'session-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@sessionStatus',
        'controller' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@sessionStatus',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'session.status',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'schedule.logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'schedule-logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@scheduleLogout',
        'controller' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@scheduleLogout',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'schedule.logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cancel.logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'cancel-logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@cancelLogout',
        'controller' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@cancelLogout',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cancel.logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debug.schedule' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'debug-schedule',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@checkScheduledLogout',
        'controller' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@checkScheduledLogout',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'debug.schedule',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'detailCourse' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'khoa-hoc/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\CourseController@detailCourse',
        'controller' => 'App\\Http\\Controllers\\Client\\CourseController@detailCourse',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'detailCourse',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'category.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'danh-muc/{slug?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\CategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Client\\CategoryController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'category.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dang-xuat',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@logout',
        'controller' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@logout',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'checkout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'thanh-toan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\PaymentController@showQrPayment',
        'controller' => 'App\\Http\\Controllers\\Client\\PaymentController@showQrPayment',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'checkout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'payment.qr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'thanh-toan/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\PaymentController@showQrPayment',
        'controller' => 'App\\Http\\Controllers\\Client\\PaymentController@showQrPayment',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'payment.qr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'payment.expired' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'thanh-toan/expired',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\PaymentController@expired',
        'controller' => 'App\\Http\\Controllers\\Client\\PaymentController@expired',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'payment.expired',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'payment.check-expiry' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'thanh-toan/check-expiry',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\PaymentController@checkPaymentExpiry',
        'controller' => 'App\\Http\\Controllers\\Client\\PaymentController@checkPaymentExpiry',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
          0 => 'csrf',
        ),
        'as' => 'payment.check-expiry',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'profile.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tai-khoan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@profile',
        'controller' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@profile',
        'as' => 'profile.index',
        'namespace' => NULL,
        'prefix' => '/tai-khoan',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'profile.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'tai-khoan/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@updateProfile',
        'controller' => 'App\\Http\\Controllers\\Client\\auth\\AuthController@updateProfile',
        'as' => 'profile.update',
        'namespace' => NULL,
        'prefix' => '/tai-khoan',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'course.learning' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hoc-khoa-hoc/{courseSlug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\CourseController@learning',
        'controller' => 'App\\Http\\Controllers\\Client\\CourseController@learning',
        'namespace' => NULL,
        'prefix' => '/hoc-khoa-hoc',
        'where' => 
        array (
        ),
        'as' => 'course.learning',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'course.learning.video' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hoc-khoa-hoc/{courseSlug}/bai-hoc/{lessonSlug}/video/{videoSlug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\CourseController@learning',
        'controller' => 'App\\Http\\Controllers\\Client\\CourseController@learning',
        'namespace' => NULL,
        'prefix' => '/hoc-khoa-hoc',
        'where' => 
        array (
        ),
        'as' => 'course.learning.video',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'course.learning.test' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hoc-khoa-hoc/{courseSlug}/bai-hoc/{lessonSlug}/bai-kiem-tra/{testSlug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\CourseController@learning',
        'controller' => 'App\\Http\\Controllers\\Client\\CourseController@learning',
        'namespace' => NULL,
        'prefix' => '/hoc-khoa-hoc',
        'where' => 
        array (
        ),
        'as' => 'course.learning.test',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'client.comments.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'comments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
          4 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\CommentController@store',
        'controller' => 'App\\Http\\Controllers\\Client\\CommentController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'client.comments.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'client.comments.reply' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'comments/{comment}/reply',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
          4 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\CommentController@reply',
        'controller' => 'App\\Http\\Controllers\\Client\\CommentController@reply',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'client.comments.reply',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'client.ratings.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ratings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
          4 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\CommentController@storeRating',
        'controller' => 'App\\Http\\Controllers\\Client\\CommentController@storeRating',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'client.ratings.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'client.courses.comments' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'courses/{courseId}/comments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\CommentController@getCourseComments',
        'controller' => 'App\\Http\\Controllers\\Client\\CommentController@getCourseComments',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'client.courses.comments',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'test.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'test/{test}/submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\TestResultController@submit',
        'controller' => 'App\\Http\\Controllers\\Client\\TestResultController@submit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'test.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'test.retry' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'test/{test}/retry',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\TestResultController@retry',
        'controller' => 'App\\Http\\Controllers\\Client\\TestResultController@retry',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'test.retry',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'practice-tests.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'thi-thu-toeic',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'jwt',
          3 => 'prevent-back-history',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\PracticeTestController@index',
        'controller' => 'App\\Http\\Controllers\\Client\\PracticeTestController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'practice-tests.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'lessons.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'lessons/{lessonId}/{enrollmentId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:127:"function ($lessonId, $enrollmentId) {
            return \\view(\'lessons.view\', \\compact(\'lessonId\', \'enrollmentId\'));
        }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a650000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'lessons.view',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.news.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/news',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\NewsController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\NewsController@index',
        'as' => 'online.news.index',
        'namespace' => NULL,
        'prefix' => 'online/news',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.news.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/news/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\NewsController@show',
        'controller' => 'App\\Http\\Controllers\\Online\\NewsController@show',
        'as' => 'online.news.show',
        'namespace' => NULL,
        'prefix' => 'online/news',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'clear.cache' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'clear-cache',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:180:"function () {
        \\Illuminate\\Support\\Facades\\Artisan::call(\'cache:clear\');
        return \\redirect()->back()->with(\'success\', \'Cache đã được xóa thành công!\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a670000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'clear.cache',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'clear.view' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'clear-view',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:184:"function () {
        \\Illuminate\\Support\\Facades\\Artisan::call(\'view:clear\');
        return \\redirect()->back()->with(\'success\', \'View cache đã được xóa thành công!\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a690000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'clear.view',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'clear.config' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'clear-config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:188:"function () {
        \\Illuminate\\Support\\Facades\\Artisan::call(\'config:clear\');
        return \\redirect()->back()->with(\'success\', \'Config cache đã được xóa thành công!\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a6b0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'clear.config',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'clear.all' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'clear-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:389:"function () {
        \\Illuminate\\Support\\Facades\\Artisan::call(\'cache:clear\');
        \\Illuminate\\Support\\Facades\\Artisan::call(\'view:clear\');
        \\Illuminate\\Support\\Facades\\Artisan::call(\'config:clear\');
        \\Illuminate\\Support\\Facades\\Artisan::call(\'route:clear\');
        return \\redirect()->back()->with(\'success\', \'Tất cả cache đã được xóa thành công!\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a6d0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'clear.all',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dictionary.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dictionary',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:53:"function () {
    return \\view(\'dictionary.index\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000094a0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'dictionary.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'exercises.dictation.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'exercises/dictation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\DictationController@index',
        'controller' => 'App\\Http\\Controllers\\DictationController@index',
        'namespace' => NULL,
        'prefix' => 'exercises/dictation',
        'where' => 
        array (
        ),
        'as' => 'exercises.dictation.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'exercises.dictation' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'exercises/dictation/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\DictationController@show',
        'controller' => 'App\\Http\\Controllers\\DictationController@show',
        'namespace' => NULL,
        'prefix' => 'exercises/dictation',
        'where' => 
        array (
        ),
        'as' => 'exercises.dictation',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dictation.check' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'exercises/dictation/check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\DictationController@check',
        'controller' => 'App\\Http\\Controllers\\DictationController@check',
        'namespace' => NULL,
        'prefix' => 'exercises/dictation',
        'where' => 
        array (
        ),
        'as' => 'dictation.check',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dictation.script' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'exercises/dictation/{id}/script',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\DictationController@getScript',
        'controller' => 'App\\Http\\Controllers\\DictationController@getScript',
        'namespace' => NULL,
        'prefix' => 'exercises/dictation',
        'where' => 
        array (
        ),
        'as' => 'dictation.script',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'exercises.video-dubbing.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'exercises/video-dubbing',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VideoDubbingController@index',
        'controller' => 'App\\Http\\Controllers\\VideoDubbingController@index',
        'namespace' => NULL,
        'prefix' => 'exercises/video-dubbing',
        'where' => 
        array (
        ),
        'as' => 'exercises.video-dubbing.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'exercises.video-dubbing.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'exercises/video-dubbing/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VideoDubbingController@show',
        'controller' => 'App\\Http\\Controllers\\VideoDubbingController@show',
        'namespace' => NULL,
        'prefix' => 'exercises/video-dubbing',
        'where' => 
        array (
        ),
        'as' => 'exercises.video-dubbing.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'exercises.progress.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'exercises/progress/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ExerciseProgressController@update',
        'controller' => 'App\\Http\\Controllers\\ExerciseProgressController@update',
        'namespace' => NULL,
        'prefix' => '/exercises',
        'where' => 
        array (
        ),
        'as' => 'exercises.progress.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YdExXcjjCUa0zdnJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/oxford/process-text',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\OxfordController@processText',
        'controller' => 'App\\Http\\Controllers\\OxfordController@processText',
        'namespace' => NULL,
        'prefix' => '/api/oxford',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
          0 => 'csrf',
        ),
        'as' => 'generated::YdExXcjjCUa0zdnJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5jfjfpLMFStSD396' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/oxford/word-info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\OxfordController@getWordInfo',
        'controller' => 'App\\Http\\Controllers\\OxfordController@getWordInfo',
        'namespace' => NULL,
        'prefix' => '/api/oxford',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
          0 => 'csrf',
        ),
        'as' => 'generated::5jfjfpLMFStSD396',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'video-exercise.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'video-exercise/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VideoExerciseController@show',
        'controller' => 'App\\Http\\Controllers\\VideoExerciseController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'video-exercise.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reflection-exercise.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reflection-exercise/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ReflectionExerciseController@show',
        'controller' => 'App\\Http\\Controllers\\ReflectionExerciseController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'reflection-exercise.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'video-handout.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'video-handout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VideoHandoutController@show',
        'controller' => 'App\\Http\\Controllers\\VideoHandoutController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'video-handout.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'video-shadowing.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'video-shadowing',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VideoShadowingController@show',
        'controller' => 'App\\Http\\Controllers\\VideoShadowingController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'video-shadowing.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'vocabulary-listening.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'vocabulary-listening',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VocabularyListeningController@show',
        'controller' => 'App\\Http\\Controllers\\VocabularyListeningController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'vocabulary-listening.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'auth.facebook' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'auth/facebook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\Auth\\SocialLoginController@redirectToFacebook',
        'controller' => 'App\\Http\\Controllers\\Client\\Auth\\SocialLoginController@redirectToFacebook',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'auth.facebook',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'auth.facebook.callback' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'auth/facebook/callback',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Client\\Auth\\SocialLoginController@handleFacebookCallback',
        'controller' => 'App\\Http\\Controllers\\Client\\Auth\\SocialLoginController@handleFacebookCallback',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'auth.facebook.callback',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'guest',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:77:"function() {
            return \\redirect()->route(\'online.login\');
        }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a840000000000000000";}}',
        'as' => 'online.',
        'namespace' => NULL,
        'prefix' => '/online',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Auth\\LoginController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Online\\Auth\\LoginController@showLoginForm',
        'as' => 'online.login',
        'namespace' => NULL,
        'prefix' => '/online',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.login.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'online/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Online\\Auth\\LoginController@login',
        'as' => 'online.login.post',
        'namespace' => NULL,
        'prefix' => '/online',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.auth.google' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/auth/google',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Auth\\GoogleLoginController@redirectToGoogle',
        'controller' => 'App\\Http\\Controllers\\Online\\Auth\\GoogleLoginController@redirectToGoogle',
        'as' => 'online.auth.google',
        'namespace' => NULL,
        'prefix' => '/online',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.auth.google.callback' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/auth/google/callback',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Auth\\GoogleLoginController@handleGoogleCallback',
        'controller' => 'App\\Http\\Controllers\\Online\\Auth\\GoogleLoginController@handleGoogleCallback',
        'as' => 'online.auth.google.callback',
        'namespace' => NULL,
        'prefix' => '/online',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'online/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Auth\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Online\\Auth\\LoginController@logout',
        'as' => 'online.logout',
        'namespace' => NULL,
        'prefix' => '/online',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\NewsController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\NewsController@index',
        'as' => 'online.dashboard',
        'namespace' => NULL,
        'prefix' => '/online',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.exercises.video' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/exercises/video/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\MaterialController@videoExercise',
        'controller' => 'App\\Http\\Controllers\\Online\\MaterialController@videoExercise',
        'as' => 'online.exercises.video',
        'namespace' => NULL,
        'prefix' => 'online/exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.exercises.audio' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/exercises/audio/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\MaterialController@audioExercise',
        'controller' => 'App\\Http\\Controllers\\Online\\MaterialController@audioExercise',
        'as' => 'online.exercises.audio',
        'namespace' => NULL,
        'prefix' => 'online/exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.exercises.grammar' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/exercises/grammar/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\MaterialController@grammarExercise',
        'controller' => 'App\\Http\\Controllers\\Online\\MaterialController@grammarExercise',
        'as' => 'online.exercises.grammar',
        'namespace' => NULL,
        'prefix' => 'online/exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.exercises.video-series' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/exercises/video-series/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\MaterialController@videoSeries',
        'controller' => 'App\\Http\\Controllers\\Online\\MaterialController@videoSeries',
        'as' => 'online.exercises.video-series',
        'namespace' => NULL,
        'prefix' => 'online/exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.exercises.audio-collection' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/exercises/audio-collection/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\MaterialController@audioCollection',
        'controller' => 'App\\Http\\Controllers\\Online\\MaterialController@audioCollection',
        'as' => 'online.exercises.audio-collection',
        'namespace' => NULL,
        'prefix' => 'online/exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.exercises.games' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/exercises/games/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\MaterialController@vocabularyGames',
        'controller' => 'App\\Http\\Controllers\\Online\\MaterialController@vocabularyGames',
        'as' => 'online.exercises.games',
        'namespace' => NULL,
        'prefix' => 'online/exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.exercises.video.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'online/exercises/video/{id}/submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\MaterialController@submitVideoExercise',
        'controller' => 'App\\Http\\Controllers\\Online\\MaterialController@submitVideoExercise',
        'as' => 'online.exercises.video.submit',
        'namespace' => NULL,
        'prefix' => 'online/exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.exercises.audio.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'online/exercises/audio/{id}/submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\MaterialController@submitAudioExercise',
        'controller' => 'App\\Http\\Controllers\\Online\\MaterialController@submitAudioExercise',
        'as' => 'online.exercises.audio.submit',
        'namespace' => NULL,
        'prefix' => 'online/exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.exercises.grammar.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'online/exercises/grammar/{id}/submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\MaterialController@submitGrammarExercise',
        'controller' => 'App\\Http\\Controllers\\Online\\MaterialController@submitGrammarExercise',
        'as' => 'online.exercises.grammar.submit',
        'namespace' => NULL,
        'prefix' => 'online/exercises',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.classes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/classes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\ClassStudentController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\ClassStudentController@index',
        'as' => 'online.classes.index',
        'namespace' => NULL,
        'prefix' => 'online/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.classes.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/classes/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\ClassStudentController@show',
        'controller' => 'App\\Http\\Controllers\\Online\\ClassStudentController@show',
        'as' => 'online.classes.show',
        'namespace' => NULL,
        'prefix' => 'online/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.classes.tests' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/classes/{class_id}/tests',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\TestController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\TestController@index',
        'as' => 'online.classes.tests',
        'namespace' => NULL,
        'prefix' => 'online/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.classes.quiz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/classes/quiz/{quiz}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\ClassStudentController@quiz',
        'controller' => 'App\\Http\\Controllers\\Online\\ClassStudentController@quiz',
        'as' => 'online.classes.quiz',
        'namespace' => NULL,
        'prefix' => 'online/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.sessions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/sessions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\SessionController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\SessionController@index',
        'as' => 'online.sessions.index',
        'namespace' => NULL,
        'prefix' => 'online/sessions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.sessions.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/sessions/{session}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\SessionController@show',
        'controller' => 'App\\Http\\Controllers\\Online\\SessionController@show',
        'as' => 'online.sessions.show',
        'namespace' => NULL,
        'prefix' => 'online/sessions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.sessions.join' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/sessions/{session}/join',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\SessionController@join',
        'controller' => 'App\\Http\\Controllers\\Online\\SessionController@join',
        'as' => 'online.sessions.join',
        'namespace' => NULL,
        'prefix' => 'online/sessions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.schedule' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/schedule',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\ScheduleController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\ScheduleController@index',
        'as' => 'online.schedule',
        'namespace' => NULL,
        'prefix' => '/online',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.tests.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/tests',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\TestController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\TestController@index',
        'as' => 'online.tests.index',
        'namespace' => NULL,
        'prefix' => 'online/tests',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.tests.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/tests/{test_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\TestController@show',
        'controller' => 'App\\Http\\Controllers\\Online\\TestController@show',
        'as' => 'online.tests.show',
        'namespace' => NULL,
        'prefix' => 'online/tests',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.tests.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'online/tests/{test_id}/submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\TestController@submit',
        'controller' => 'App\\Http\\Controllers\\Online\\TestController@submit',
        'as' => 'online.tests.submit',
        'namespace' => NULL,
        'prefix' => 'online/tests',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.tests.result' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/tests/{test_id}/result',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\TestController@result',
        'controller' => 'App\\Http\\Controllers\\Online\\TestController@result',
        'as' => 'online.tests.result',
        'namespace' => NULL,
        'prefix' => 'online/tests',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.grades.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/grades',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\GradeController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\GradeController@index',
        'as' => 'online.grades.index',
        'namespace' => NULL,
        'prefix' => 'online/grades',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.grades.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/grades/{class_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\GradeController@show',
        'controller' => 'App\\Http\\Controllers\\Online\\GradeController@show',
        'as' => 'online.grades.show',
        'namespace' => NULL,
        'prefix' => 'online/grades',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.grades.detail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/grades/detail/{assessment_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:student',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\GradeController@detail',
        'controller' => 'App\\Http\\Controllers\\Online\\GradeController@detail',
        'as' => 'online.grades.detail',
        'namespace' => NULL,
        'prefix' => 'online/grades',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.schedule' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/schedule',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Teacher\\ScheduleController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\Teacher\\ScheduleController@index',
        'as' => 'online.teacher.schedule',
        'namespace' => NULL,
        'prefix' => 'online/teacher',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.classes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/classes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@index',
        'as' => 'online.teacher.classes.index',
        'namespace' => NULL,
        'prefix' => 'online/teacher/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.classes.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/classes/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@show',
        'controller' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@show',
        'as' => 'online.teacher.classes.show',
        'namespace' => NULL,
        'prefix' => 'online/teacher/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.classes.attendance' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/classes/{id}/attendance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@attendance',
        'controller' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@attendance',
        'as' => 'online.teacher.classes.attendance',
        'namespace' => NULL,
        'prefix' => 'online/teacher/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.classes.progress.video-exercise' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/classes/{id}/progress/video-exercise',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@videoExerciseProgress',
        'controller' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@videoExerciseProgress',
        'as' => 'online.teacher.classes.progress.video-exercise',
        'namespace' => NULL,
        'prefix' => 'online/teacher/classes/{id}/progress',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.classes.progress.vocabulary' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/classes/{id}/progress/vocabulary',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@vocabularyProgress',
        'controller' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@vocabularyProgress',
        'as' => 'online.teacher.classes.progress.vocabulary',
        'namespace' => NULL,
        'prefix' => 'online/teacher/classes/{id}/progress',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.classes.progress.handout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/classes/{id}/progress/handout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@handoutProgress',
        'controller' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@handoutProgress',
        'as' => 'online.teacher.classes.progress.handout',
        'namespace' => NULL,
        'prefix' => 'online/teacher/classes/{id}/progress',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.classes.progress.shadowing' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/classes/{id}/progress/shadowing',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@shadowingProgress',
        'controller' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@shadowingProgress',
        'as' => 'online.teacher.classes.progress.shadowing',
        'namespace' => NULL,
        'prefix' => 'online/teacher/classes/{id}/progress',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.classes.progress.reflection' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/classes/{id}/progress/reflection',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@reflectionProgress',
        'controller' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@reflectionProgress',
        'as' => 'online.teacher.classes.progress.reflection',
        'namespace' => NULL,
        'prefix' => 'online/teacher/classes/{id}/progress',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.classes.materials.upload' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'online/teacher/classes/{id}/materials/upload',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@uploadMaterial',
        'controller' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@uploadMaterial',
        'as' => 'online.teacher.classes.materials.upload',
        'namespace' => NULL,
        'prefix' => 'online/teacher/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.classes.materials.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'online/teacher/classes/materials/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@deleteMaterial',
        'controller' => 'App\\Http\\Controllers\\Online\\Teacher\\ClassController@deleteMaterial',
        'as' => 'online.teacher.classes.materials.delete',
        'namespace' => NULL,
        'prefix' => 'online/teacher/classes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.grades.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/grades',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\GradeController@teacherIndex',
        'controller' => 'App\\Http\\Controllers\\Online\\GradeController@teacherIndex',
        'as' => 'online.teacher.grades.index',
        'namespace' => NULL,
        'prefix' => 'online/teacher/grades',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.grades.class' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/grades/class/{class_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\GradeController@classGrades',
        'controller' => 'App\\Http\\Controllers\\Online\\GradeController@classGrades',
        'as' => 'online.teacher.grades.class',
        'namespace' => NULL,
        'prefix' => 'online/teacher/grades',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.grades.student' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/grades/student/{student_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\GradeController@studentGrades',
        'controller' => 'App\\Http\\Controllers\\Online\\GradeController@studentGrades',
        'as' => 'online.teacher.grades.student',
        'namespace' => NULL,
        'prefix' => 'online/teacher/grades',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.grades.assessment' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/grades/assessment/{assessment_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\GradeController@assessmentGrades',
        'controller' => 'App\\Http\\Controllers\\Online\\GradeController@assessmentGrades',
        'as' => 'online.teacher.grades.assessment',
        'namespace' => NULL,
        'prefix' => 'online/teacher/grades',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.grades.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'online/teacher/grades/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\GradeController@updateGrades',
        'controller' => 'App\\Http\\Controllers\\Online\\GradeController@updateGrades',
        'as' => 'online.teacher.grades.update',
        'namespace' => NULL,
        'prefix' => 'online/teacher/grades',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.teacher.grades.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/teacher/grades/export/{class_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
          4 => 'jwt.role:teacher,teaching_assistant',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\GradeController@exportGrades',
        'controller' => 'App\\Http\\Controllers\\Online\\GradeController@exportGrades',
        'as' => 'online.teacher.grades.export',
        'namespace' => NULL,
        'prefix' => 'online/teacher/grades',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.attendance.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/attendance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\AttendanceController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\AttendanceController@index',
        'as' => 'online.attendance.index',
        'namespace' => NULL,
        'prefix' => 'online/attendance',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.attendance.detail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/attendance/detail/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\AttendanceController@detail',
        'controller' => 'App\\Http\\Controllers\\Online\\AttendanceController@detail',
        'as' => 'online.attendance.detail',
        'namespace' => NULL,
        'prefix' => 'online/attendance',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.attendance.save' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'online/attendance/save/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\AttendanceController@saveAttendance',
        'controller' => 'App\\Http\\Controllers\\Online\\AttendanceController@saveAttendance',
        'as' => 'online.attendance.save',
        'namespace' => NULL,
        'prefix' => 'online/attendance',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.attendance.sessions' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/attendance/sessions/{class}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\AttendanceController@sessions',
        'controller' => 'App\\Http\\Controllers\\Online\\AttendanceController@sessions',
        'as' => 'online.attendance.sessions',
        'namespace' => NULL,
        'prefix' => 'online/attendance',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.attendance.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/attendance/{class}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\AttendanceController@show',
        'controller' => 'App\\Http\\Controllers\\Online\\AttendanceController@show',
        'as' => 'online.attendance.show',
        'namespace' => NULL,
        'prefix' => 'online/attendance',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.awards.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/awards',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\AwardController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\AwardController@index',
        'as' => 'online.awards.index',
        'namespace' => NULL,
        'prefix' => 'online/awards',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.awards.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/awards/{award}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\AwardController@show',
        'controller' => 'App\\Http\\Controllers\\Online\\AwardController@show',
        'as' => 'online.awards.show',
        'namespace' => NULL,
        'prefix' => 'online/awards',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.guides.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/guides',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\GuideController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\GuideController@index',
        'as' => 'online.guides.index',
        'namespace' => NULL,
        'prefix' => 'online/guides',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.guides.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/guides/{topic}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\GuideController@show',
        'controller' => 'App\\Http\\Controllers\\Online\\GuideController@show',
        'as' => 'online.guides.show',
        'namespace' => NULL,
        'prefix' => 'online/guides',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.support.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/support',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\SupportController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\SupportController@index',
        'as' => 'online.support.index',
        'namespace' => NULL,
        'prefix' => 'online/support',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.support.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'online/support/ticket',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\SupportController@store',
        'controller' => 'App\\Http\\Controllers\\Online\\SupportController@store',
        'as' => 'online.support.store',
        'namespace' => NULL,
        'prefix' => 'online/support',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.ebooks.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/ebooks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\EbookController@index',
        'controller' => 'App\\Http\\Controllers\\Online\\EbookController@index',
        'as' => 'online.ebooks.index',
        'namespace' => NULL,
        'prefix' => 'online/ebooks',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'online.ebooks.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'online/ebooks/{ebook}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
          2 => 'auth:employee',
          3 => 'jwt.role',
        ),
        'uses' => 'App\\Http\\Controllers\\Online\\EbookController@show',
        'controller' => 'App\\Http\\Controllers\\Online\\EbookController@show',
        'as' => 'online.ebooks.show',
        'namespace' => NULL,
        'prefix' => 'online/ebooks',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
