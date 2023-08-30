<?php

declare(strict_types=1);

namespace App\Services\BuildReport;

/**
 * Class ExtractDataFromFile
 *
 * This class is responsible for extracting data from a file.
 */
class ExtractDataFromFile
{
     /**
     * Extracts data from the specified file.
     *
     * @param string $pathToFile The path to the file from which data should be extracted.
     * @return string The extracted data from the file.
     * @throws \InvalidArgumentException If the provided file is empty.
     */
    public function extractingDataFromFile(string $pathToFile): string
    {
        
        $dataFromFile = file_get_contents($pathToFile);

        $this->validateFileData($dataFromFile);

        return $dataFromFile;
    }

    private function validateFileData(bool|string $dataFromFile): void
    {
        if (empty($dataFromFile)) {
            throw new \InvalidArgumentException('File can not be empty');
        }
    }
}