<?php

namespace PhpDruidIngest\ResponseHandler;

use DruidFamiliar\ResponseHandler\DoNothingResponseHandler;
use GuzzleHttp\Psr7\Response;

/**
 * Class IndexingTaskResponseHandler returns the task id.
 *
 * @package PhpDruidIngest\ResponseHandler
 */
class IndexingTaskResponseHandler extends DoNothingResponseHandler
{

    /**
     * Hook function to parse the task id from the response from server.
     *
     * This hook must return the response, whether changed or not, so that the rest of the system can continue with it.
     *
     * @param Response $response
     * @return mixed
     */
    public function handleResponse($response)
    {
        $response = json_decode((string) $response->getBody(), true);

        if ( !isset( $response['task'] ) ) {
            throw new \Exception("Unexpected response"); // TODO Replace with subclassed exception
        }

        $taskId = $response['task'];
        return $taskId;
    }

}
