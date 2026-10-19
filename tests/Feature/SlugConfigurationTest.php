<?php

namespace Tests\Feature;

use Tests\TestCase;

class SlugConfigurationTest extends TestCase
{
    public function test_slug_generation_stays_callable_and_supports_thai_after_config_caching()
    {
        $slugger = config('sluggable.method');

        $this->assertTrue(is_callable($slugger));
        $this->assertSame('ข่าว-ใหม่-Test-123', call_user_func($slugger, ' ข่าว ใหม่ (Test 123) ', '-'));
    }
}
