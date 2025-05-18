<?php

declare(strict_types=1);

namespace UI\Http\Extractor;

use Domain\Availability\AvailabilityCollection;
use Domain\Availability\Availability;

final class AvailabilityExtractor
{
    public function extract(Availability $availability): array
    {
        return [
            'start' => $availability->getStartTime()->format('Y-m-d H:i:s'),
            'end' => $availability->getEndTime()->format('Y-m-d H:i:s'),
        ];
    }

    public function extractCollection(AvailabilityCollection $availabilities): array
    {
        $result = [];

        foreach ($availabilities as $availability) {
            $result[] = $this->extract($availability);
        }

        return $result;
    }
}
