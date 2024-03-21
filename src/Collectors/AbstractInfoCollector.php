<?php

namespace Miyamoto\Collectors;

use Miyamoto\IO\ConsoleFacade;

abstract class AbstractInfoCollector
{
    protected ConsoleFacade $consoleFacade;

    public function __construct(ConsoleFacade $consoleFacade)
    {
        $this->consoleFacade = $consoleFacade;
    }

    // Template method
    public function collect(): array
    {
        $data = [];
        foreach ($this->getInfo() as $key => $details) {
            $message = $details['question'];
            if (isset($details['default'])) {
                $message .= " [default: {$details['default']}]";
            }
            $this->consoleFacade->inform($message);
            $input = $this->consoleFacade->prompt('');
            $data[$key] = $input ?: $details['default'] ?? '';
        }
        return $data;
    }

    // Subclasses will define their specific questions here
    abstract protected function getInfo(): array;
}