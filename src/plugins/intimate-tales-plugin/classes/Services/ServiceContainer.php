<?php
namespace IntimateTales\Services;

use IntimateTales\Models\Dependencies;

/**
 * Class ServiceContainer
 *
 * @package IntimateTales\Services
 */
class ServiceContainer extends Dependencies
{
    /**
     * Add a service to the container.
     *
     * @param string $service_name
     * @param mixed $service
     */
    public function add_service(string $service_name, $service) 
    {
        $this->add_handle($service_name, $service);
    }

    /**
     * Get a service from the container.
     *
     * @param string $service_name
     * @return mixed|null
     */
    public function get(): array
    {
        return $this->services;
    }
}