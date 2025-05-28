<?
namespace framework\services;

interface IMiddleware
{
    /**
     * @param ?string $response
     * @return void
     */
    public function process(?string $response): string;
}