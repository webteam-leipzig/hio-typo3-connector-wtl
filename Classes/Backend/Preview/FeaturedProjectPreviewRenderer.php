<?php

namespace Wtl\HioTypo3ConnectorWtl\Backend\Preview;

use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Backend\Preview\StandardContentPreviewRenderer;
use Wtl\HioTypo3Connector\Domain\Repository\ProjectRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FeaturedProjectPreviewRenderer extends StandardContentPreviewRenderer
{
    protected ?ProjectRepository $projectRepository = null;
    
    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        if ($this->projectRepository === null) {
            $this->projectRepository = GeneralUtility::makeInstance(ProjectRepository::class);
        }
        
        $otherContentPreview = parent::renderPageModulePreviewContent($item);
        
        $row = $item->getRecord();
        $uid = $row['tx_hiotypo3connectorwtl_featured_project'];
        
        $project = $this->projectRepository->findByUid($uid);

        return $otherContentPreview . '<br /><p>' . htmlspecialchars($project->getTitle()) . '</p>';
        
    }
}
