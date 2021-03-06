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
        $tags = ['name' => $tagLabel];

        return $this->create($uri, $tags);
    }

    public function update($modelId, array $details)
    {
        $response = $this->client->put(sprintf('companies/%s/', $modelId), [
            'json' => $details,
        ]);

        return $this->handleResponse($response);
    }

    public function setAttributesUsingCompanyId($companyId, array $attributes)
    {
        return $this->create(sprintf('companies-by-id/%s/set_multiple_attributes/', $companyId), $attributes);
    }

    public function setAttributes($modelId, array $attributes)
    {
        return $this->create(sprintf('companies/:id/set_multiple_attributes/', $modelId), $attributes);
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
