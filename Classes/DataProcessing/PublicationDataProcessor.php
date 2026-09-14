<?php

namespace Wtl\HioTypo3ConnectorWtl\DataProcessing;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use Wtl\HioTypo3Connector\Domain\Repository\PublicationRepository;


class PublicationDataProcessor implements DataProcessorInterface
{
    public function __construct(private PublicationRepository $publicationRepository)
    {
    }

    /**
     * @inheritDoc
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        $fieldName = $processorConfiguration['fieldName'] ?? '';
        $as = $processorConfiguration['as'] ?? 'featuredPublication';
        if (!is_string($fieldName) || !is_string($as)) {
            return $processedData;
        }

        $data = $processedData['data'] ?? null;
        $publicationUid = is_array($data) ? ($data[$fieldName] ?? null) : null;
        $publicationUid = filter_var($publicationUid, FILTER_VALIDATE_INT);

        $processedData[$as] = $publicationUid !== false && $publicationUid > 0
            ? $this->publicationRepository->findByUid($publicationUid)
            : null;

        return $processedData;
    }
}
