<?php
class BaseModel
{
    protected $db;
    protected $attributes = [];

    public function __construct(array $data = [])
    {
        $this->db = new Database();

        foreach ($data as $key => $value) {
            $this->__set($key, $value);
        }
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function toArray()
    {
        return $this->attributes;
    }
}
