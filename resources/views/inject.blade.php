@inject('test', 'App\Contracts\TestContract')

Test: {{ $test->callMe('inject') }}
