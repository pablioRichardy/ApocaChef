<?
namespace framework\services;

interface IMiddleware
{
    /**
     * @param ?string $response
     * @return void
     */
    public function process(array|string $response): string;
}