<?php

interface MiddlewareInterface
{
    public function handle(callable $next);
}
