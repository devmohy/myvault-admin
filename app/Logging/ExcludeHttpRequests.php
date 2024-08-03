<?php
namespace App\Logging;

use Illuminate\Log\Logger;


class ExcludeHttpRequests
{
    public function __invoke($record)
    {
        // Ensure that $record is an array before attempting to access its elements
        if (is_array($record) && isset($record['message']) && preg_match('/^(GET|POST|PUT|PATCH|DELETE|OPTIONS|HEAD)\s/i', $record['message'])) {
            return false; // If the log entry matches the pattern, exclude it.
        }
        return $record; // Otherwise, include it in the logs.
    }
}
