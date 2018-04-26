<?php

namespace Gc\UserEngage\Http;

use Gc\UserEngage\AbstractResource;

/**
 * Class Company
 * @package Gc\UserEngage\Http
 */
final class Company extends AbstractResource
{
    /**
     * @param array $detail
     * @return array
     */
    public function add(array $detail)
    {
        return $this->create('companies/', $detail);
    }

    /**
     * Find company by company_id.
     *
     * @param string $companyId
     * @return string
     */
    public function findByCompanyId($companyId)
    {
        return $this->find(sprintf('companies-by-id/%s', $companyId));
    }
    /**
     * Find company by model id.
     *
     * @param string $identifier
     * @return string
     */
    public function findById($identifier)
    {
        return $this->find(sprintf('companies/%s', $identifier));
    }

    public function addTag($companyId, $tagLabel)
    {
        $uri = sprintf('companies-by-id/%s/add_tag/', $companyId);

        $tagLabels = (is_string($tagLabel)) ? [$tagLabel] : $tagLabel;
        $tags = [];
        foreach ($tagLabels as $tagLabel) {
            $tags[] = ['name' => $tagLabel];
        }

        return $this->create($uri, $tags);
    }


    /**
     * Simple HTTP DELETE request to Company API to delete company.
     *
     * @param $id
     * @return string
     */
    public function delete($id)
    {
        return parent::delete(sprintf('companies/%s/', $id));
    }
    /**
     * Simple HTTP DELETE request to Company API to delete company.
     *
     * @param $companyId
     * @return string
     */
    public function deleteByCompanyId($companyId)
    {
        return parent::delete(sprintf('companies-by-id/%s/', $companyId));
    }
}
