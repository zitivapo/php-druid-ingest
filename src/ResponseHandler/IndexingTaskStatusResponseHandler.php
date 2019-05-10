<?php

namespace PhpDruidIngest\ResponseHandler;

use DruidFamiliar\Interfaces\IDruidQueryResponseHandler;
use GuzzleHttp\Psr7\Response;
use PhpDruidIngest\QueryResponse\IndexingTaskStatusQueryResponse;

class IndexingTaskStatusResponseHandler implements IDruidQueryResponseHandler
{

    /**
     * Hook function to parse the task status from the response from server.
     *
     * This hook must return the response, whether changed or not, so that the rest of the system can continue with it.
     *
     * @param Response $response
     * @return IndexingTaskStatusQueryResponse|mixed
     * @throws \Exception
     */
    public function handleResponse($response)
    {
        $taskStatus = new IndexingTaskStatusQueryResponse();

        $response = json_decode((string) $response->getBody(), true);


        if ( !isset( $response['status'] ) ) {
            throw new \Exception("Unexpected response"); // TODO Replace with subclassed exception
        }
        $responseStatus = $response['status'];


        if ( !isset( $response['task'] ) ) {
            throw new \Exception("Unexpected response"); // TODO Replace with subclassed exception
        }
        $taskStatus->setTask( $response['task'] );

        if ( !isset( $responseStatus['id'] ) ) {
            throw new \Exception("Unexpected response"); // TODO Replace with subclassed exception
        }
        $taskStatus->setId( $responseStatus['id'] );

        if ( !isset( $responseStatus['statusCode'] ) ) {
            throw new \Exception("Unexpected response"); // TODO Replace with subclassed exception
        }
        $taskStatus->setStatusCode( $responseStatus['statusCode'] );

        if ( !isset( $responseStatus['duration'] ) ) {
            throw new \Exception("Unexpected response"); // TODO Replace with subclassed exception
        }
        $taskStatus->setDuration( $responseStatus['duration'] );


        return $taskStatus;
    }

}
