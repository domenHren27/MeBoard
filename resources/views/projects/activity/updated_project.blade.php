@if (count($activity->changes['after']) == 1)
    {{$activity->user->name}} uredil {{ key($activity->changes['after']) }} of the project

@else
    {{$activity->user->name}}Ti si uredil
@endif