<?php

namespace Wtl\HioTypo3ConnectorWtl\DataProcessing;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use Wtl\HioTypo3Connector\Domain\Repository\ProjectRepository;


class ProjectDataProcessor implements DataProcessorInterface
{
    public function __construct(private ProjectRepository $projectRepository)
    {
    }

    /**
     * @inheritDoc
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        $fieldName = $processorConfiguration['fieldName'] ?? '';
        $as = $processorConfiguration['as'] ?? 'featuredProject';
        if (!is_string($fieldName) || !is_string($as)) {
            return $processedData;
        }

        $data = $processedData['data'] ?? null;
        $projectUid = is_array($data) ? ($data[$fieldName] ?? null) : null;
        $projectUid = filter_var($projectUid, FILTER_VALIDATE_INT);

        $processedData[$as] = $projectUid !== false && $projectUid > 0
            ? $this->projectRepository->findByUid($projectUid)
            : null;

        return $processedData;
    }
}
