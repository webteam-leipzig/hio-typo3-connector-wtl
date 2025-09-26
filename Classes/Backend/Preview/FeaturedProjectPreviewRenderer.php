<?php

namespace WTL\HioTypo3ConnectorWtl\Backend\Preview;

use TYPO3\CMS\Backend\Preview\PreviewRendererInterface;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;

class FeaturedProjectPreviewRenderer implements PreviewRendererInterface
{
    public function renderPageModulePreviewHeader(GridColumnItem $item): string
    {
        // No custom header, return empty string
        return 'HEADER';
    }

    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($item, 'Optional Title');
        $row = $item->getRecord();
        $uids = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(',', $row['tx_hiotypo3connectorwtl_featured_project'] ?? '', true);
        $projects = [];

        if (!empty($uids)) {
            $queryBuilder = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)
                ->getQueryBuilderForTable('tx_hiotypo3connector_domain_model_project');
            $result = $queryBuilder
                ->select('uid', 'title')
                ->from('tx_hiotypo3connector_domain_model_project')
                ->where(
                    $queryBuilder->expr()->in(
                        'uid',
                        $queryBuilder->createNamedParameter($uids, \TYPO3\CMS\Core\Database\Connection::PARAM_INT_ARRAY)
                    )
                )
                ->executeQuery()
                ->fetchAllAssociative();

            $projects = $result ?: [];
        }

        $output = '<strong>Selected Project(s):</strong><ul>';
        foreach ($projects as $project) {
            $output .= '<li>' . htmlspecialchars($project['title']) . '</li>';
        }
        $output .= '</ul>';

        return $output;
    }

    public function renderPageModulePreviewFooter(GridColumnItem $item): string
    {
        // No custom footer, return empty string
        return 'FOOTER';
    }

    public function wrapPageModulePreview(string $previewHeader, string $previewContent, GridColumnItem $item): string
    {
        // Combine header, content, and footer
        return $previewHeader . $previewContent . $this->renderPageModulePreviewFooter($item);
    }
}
