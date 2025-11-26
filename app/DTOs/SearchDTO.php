<?php

namespace App\DTOs;

class SearchDTO
{

    public function __construct(
        public string $type,       // 'Family'|'Genus'|'Species'
        public string $name,
        public string $id,         // code id (family_code, genus_code, species_code)
        public ?string $details = null,
        public ?string $thumbnail = null,
        public ?array $meta = null
    ) {}

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'name' => $this->name,
            'id' => $this->id,
            'details' => $this->details,
            'images' => $this->thumbnail,
            'meta' => $this->meta,
        ];
    }

    // public static function fromElasticHit(array $hit): self
    // {
    //     // hit['_source'] should contain minimal fields we stored in ES
    //     $s = $hit['_source'] ?? [];
    //     return new self(
    //         type: $s['type'] ?? ($hit['_type'] ?? 'Species'),
    //         name: $s['name'] ?? ($hit['name'] ?? ''),
    //         id: (string) ($s['code'] ?? $hit['_id']),
    //         details: $s['snippet'] ?? null,
    //         thumbnail: $s['thumbnail'] ?? null,
    //         meta: $s['meta'] ?? null
    //     );
    // }
}

