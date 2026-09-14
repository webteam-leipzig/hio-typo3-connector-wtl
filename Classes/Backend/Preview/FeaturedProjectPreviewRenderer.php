<?php

namespace Wtl\HioTypo3ConnectorWtl\Backend\Preview;

use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Backend\Preview\StandardContentPreviewRenderer;
use Wtl\HioTypo3Connector\Domain\Model\Project;
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
        
        $record = $item->getRecord();
        $uid = is_array($record) ? $record['tx_hiotypo3connectorwtl_featured_project'] : $record->get('tx_hiotypo3connectorwtl_featured_project');
        
        $uid = filter_var($uid, FILTER_VALIDATE_INT);

        if ($uid === false || $uid < 1) {
            return $otherContentPreview;
        }

        $project = $this->projectRepository->findByUid($uid);

        if (!$project instanceof Project) {
            return $otherContentPreview;
        }

        return $otherContentPreview . '<br /><p>' . htmlspecialchars($project->getTitle()) . '</p>';
        
    }
}
