<?php

namespace Rp76\LaravelPack\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Rp76\LaravelPack\Models\Meta;

trait Metable
{
    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setMeta($key, $value): self
    {
        $meta = $this->getMeta($key);
        if (!$meta)
            $this->meta()->create([Meta::KEY => $key, Meta::VALUE => $value]);
        else
            $this->meta()->where(Meta::KEY, $key)->update([Meta::KEY => $key, Meta::VALUE => $value]);

        return $this;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getMeta($key): mixed
    {
        return $this->meta->where(Meta::KEY, $key)->first();
    }

    /**
     * @return MorphMany
     */
    public function meta(): MorphMany
    {
        return $this->morphMany(Meta::class, "metable");
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasMeta($key): bool
    {
        return (bool)$this->meta->where(Meta::KEY, $key)->first();
    }

    /**
     * @return mixed
     */
    public function getMetas(): mixed
    {
        return $this->meta;
    }

    /**
     * @param $key
     * @param int $count
     * @return $this
     */
    public function incrementMeta($key, int $count = 1): self
    {
        $meta = $this->getMeta($key);
        if (!$meta)
            $this->meta()->create([Meta::KEY => $key, Meta::VALUE => $count]);
        else
            $this->meta()->where(Meta::KEY, $key)->increment(Meta::VALUE, $count);

        return $this;
    }

    /**
     * @param $key
     * @param int $count
     * @return $this
     */
    public function decrementMeta($key, int $count = 1): self
    {
        $meta = $this->getMeta($key);
        if (!$meta)
            $this->meta()->create([Meta::KEY => $key, Meta::VALUE => $count]);
        else
            $this->meta()->where(Meta::KEY, $key)->decrement(Meta::VALUE, $count);

        return $this;
    }
}
