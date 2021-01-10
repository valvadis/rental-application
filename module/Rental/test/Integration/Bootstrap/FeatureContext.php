<?php

namespace RentalTest\Integration\Bootstrap;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Laminas\Http\Client;
use Laminas\Http\Headers;
use Laminas\Http\Request;
use Laminas\Http\Response;
use Laminas\Json\Json;

class FeatureContext implements Context
{
    private Response $response;

    /**
     * @When I send a :method request to :url with data:
     * @When I send a :method request to :url
     */
    public function iSendARequestToWithData(string $method, string $url, PyStringNode $data = null)
    {
        $headers = new Headers();
        $headers->addHeaderLine('X-Requested-With: XMLHttpRequest');
        $headers->addHeaderLine('Content-Type: application/json');

        $request = (new Request())
            ->setMethod($method)
            ->setUri('http://0.0.0.0:8084' . $url)
            ->setHeaders($headers);

        if ($data) {
            $request->setContent($data->getRaw());
        }

        $this->response = (new Client())->send($request);
    }

    /**
     * @Then The response code should be :code
     */
    public function theResponseCodeShouldBe(int $code)
    {
        if ($this->response->getStatusCode() !== $code) {
            throw new PendingException();
        }
    }

    /**
     * @Then The response content should contain:
     */
    public function theResponseContentShouldContain(TableNode $table)
    {
        $content = Json::decode($this->response->getContent(), Json::TYPE_ARRAY);
        $tableRows = $table->getRows();
        $headers = array_shift($tableRows);

        foreach ($tableRows as $tableRowIndex => $tableRow) {
            $dataRow = $content['data'][$tableRowIndex];
            foreach ($headers as $index => $header) {
                if ($dataRow[$header] != $tableRow[$index]) {
                    throw new PendingException();
                }
            }
        }
    }
}
