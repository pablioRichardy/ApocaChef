Vou descrever quais são as regras para criar uma nova rota:

1. Adicionar uma nova linha no arquivo `api/index.php` chamando a variável `$router` junto ao método `addRoute()` que contém os parâmetros necessários para a nova rota. Como:
```PHP
$router->addRoute(
    httpMethod: "GET",
    route: "/nova-rota",
    action: new Action(
        class: "api\controllers\NovaRotaController",
        method: "index"
    ),
    authorizatation: true
);
```
O único parâmetro que pode ser omitido é o `authorizatation`, que por padrão é `false`. Portanto, se a nova rota não exigir autorização, a linha pode ser simplificada para:
```PHP
$router->addRoute(
    httpMethod: "GET",
    route: "/nova-rota",
    action: new Action(
        class: "api\controllers\NovaRotaController",
        method: "index"
    )
);
```
2. Criar o controlador correspondente em `api/controllers/NovaRotaController.php` com o método `index()`. Se for um controller que vai precisar de alguma regra de negócio, então é necessário fazer a instância do service e chamar o método necessário para obter os dados. Como:
```PHP
namespace api\controllers;

use api\services\NovaRotaService;
use framework\handlers\RequestHandler;

class NovaRotaController extends RequestHandler
{
    public function index()
    {
        $service = new NovaRotaService();
        return $service->buscarDados();
    }
}
```
Se tiver que receber algum parâmetro na requisição, você pode acessá-lo através do objeto `$this->request`. Por exemplo, para obter um parâmetro chamado `id`, você pode fazer:
```PHP
$id = $this->request->getParam('id');
```
E então o método index no controller poderia ficar assim:
```PHP
public function index()
{
    $id = $this->request->getParam('id');
    $service = new NovaRotaService();
    return $service->buscarDadosPorId($id);
}
```
3. Criar o service, caso a rota necessite de regras de negócio. O service deve ser responsável por toda a lógica de negócio e acesso a dados e também deve extender de uma DAO. Por exemplo:
```PHP
namespace api\service;

use api\dao\NovaRotaDAO;
use Exception;

class NovaRotaService extends NovaRotaDAO
{
    public function buscarDados()
    {
        return $this->buscarDados();
    }

    public function buscarDadosPorId($id)
    {
        return $this->obterPorId($id);
    }
}
```

4. Caso o service precise acessar o banco de dados, é necessário criar a DAO correspondente. A DAO deve extender da classe `api\generic\PostgresFactory` e implementar os métodos necessários para acessar os dados. Por exemplo:
```PHP
namespace api\dao;

use api\generic\PostgresFactory;

class NovaRotaDAO extends PostgresFactory
{
    public function buscarDados()
    {
        // Lógica para buscar dados no banco de dados
    }

    public function obterPorId($id)
    {
        // Lógica para obter um registro por ID no banco de dados
    }
}
```
Dentro de cada método da DAO, você deve implementar a lógica necessária para acessar o banco de dados e retornar os dados desejados. Isso pode incluir consultas SQL, manipulação de resultados e tratamento de erros que você pode pegar a seguinte referência:
```PHP
use framework\database\PostgresConnection;

class NovaRotaDAO extends PostgresConnection
{
    public function buscarDados()
    {
        $query = "SELECT * FROM nova_rota";
        $stmt = $this->banco->getConexao()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function obterPorId($id)
    {
        $query = "SELECT * FROM nova_rota WHERE id = :id";
        $stmt = $this->banco->getConexao()->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
```
Para criar as SQLs pode consultar o meu banco ver quais são as tabelas, e então adicionar a SQL necessária para fazer a operação que estou realizando.

Vou pedir para que crie uma rota e junto vou passar os parâmetros necessários e o que eu quero que essa rota faça. Para isso siga todas as intruções acima e faça a implementação.