CREATE DATABASE vagas;

USE vagas;

CREATE TABLE tb_vaga (
    IDVAGA INT PRIMARY KEY AUTO_INCREMENT,
    funcao VARCHAR(70) NOT NULL,
    tipo ENUM('T', 'E') NOT NULL,
    localTrab VARCHAR(30) NOT NULL,
    escolaridade VARCHAR(70),
    horario VARCHAR(100),
    beneficios VARCHAR(100),
    descricao VARCHAR(480),
    ID_CLIENTE INT NOT NULL,
    dataCriacao DATE NOT NULL,
    fechamento ENUM('A', 'P', 'C', 'F') NOT NULL,
    dataAlteracao DATETIME
);

CREATE TABLE tb_cliente (
    IDCLIENTE INT PRIMARY kEY AUTO_INCREMENT,
    nomeCliente VARCHAR(100) NOT NULL,
    endereco VARCHAR(100),
    bairro VARCHAR(30),
    cidade VARCHAR(30),
    estado CHAR(2),
    CNPJ VARCHAR(14), --alterar para CHAR(18)
    contato VARCHAR(30),
    email VARCHAR(70),
    telefone VARCHAR(11) --alterar para CHAR(15)
);

CREATE TABLE tb_candidato (
    IDCANDIDATO INT PRIMARY KEY AUTO_INCREMENT,
    nomeCandidato VARCHAR(70) NOT NULL,
    email VARCHAR(70),
    telefone VARCHAR(11) --alterar para CHAR(15)
);

CREATE TABLE cand_vaga (
    ID_CANDIDATO INT,
    ID_VAGA INT,
    PRIMARY KEY(ID_CANDIDATO,ID_VAGA)
);

ALTER TABLE tb_vaga ADD CONSTRAINT FK_CLIENTE_VAGA
FOREIGN KEY(ID_CLIENTE) REFERENCES tb_cliente(IDCLIENTE);

ALTER TABLE cand_vaga ADD CONSTRAINT FK_CANDIDATO
FOREIGN KEY(ID_CANDIDATO) REFERENCES tb_candidato(IDCANDIDATO);

ALTER TABLE cand_vaga ADD CONSTRAINT FK_VAGA
FOREIGN KEY(ID_VAGA) REFERENCES tb_vaga(IDVAGA);



CREATE TABLE tb_user (
    IDUSUARIO INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL,
    passwd VARCHAR(100) NOT NULL UNIQUE,
    nome_usuario VARCHAR(100) NOT NULL,
    permissoes CHAR(1)
);

INSERT INTO tb_user VALUES (null, 'jean', MD5('aczf0704'), 'Jean Marcel', null);

ALTER TABLE tb_vaga ADD COLUMN destaque char(1) ;

UPDATE tb_vaga SET destaque = 'S' WHERE IDVAGA=33;

ALTER TABLE tb_vaga CHANGE dataFechamento dataAlteracao DATETIME;


ALTER TABLE tb_vaga ADD COLUMN salario FLOAT(10,2) ;
ALTER TABLE tb_vaga ADD COLUMN ID_USUARIO INT ;

ALTER TABLE tb_vaga ADD CONSTRAINT FK_USUARIO
FOREIGN KEY(ID_USUARIO) REFERENCES tb_user(IDUSUARIO);

ALTER TABLE tb_vaga MODIFY COLUMN salario FLOAT(10,2) DEFAULT 0.00;

CREATE TABLE tb_estado (
    IDESTADO INT PRIMARY KEY AUTO_INCREMENT,
    nomeEstado varchar(30) NOT NULL UNIQUE,
    siglaEstado char(2) NOT NULL UNIQUE
);

CREATE TABLE tb_cidade (
    IDCIDADE INT PRIMARY KEY AUTO_INCREMENT,
    nomeCidade varchar(30) NOT NULL,
    ID_ESTADO INT NOT NULL
);

ALTER TABLE tb_cidade ADD CONSTRAINT FK_ESTADO
FOREIGN KEY(ID_ESTADO) REFERENCES tb_estado(IDESTADO);

ALTER TABLE tb_vaga ADD COLUMN ID_CIDADE INT;
ALTER TABLE tb_cliente ADD COLUMN ID_CIDADE INT;

ALTER TABLE tb_vaga ADD CONSTRAINT FK_CIDADE_VAGA
FOREIGN KEY(ID_CIDADE) REFERENCES tb_cidade(IDCIDADE);

ALTER TABLE tb_cliente ADD CONSTRAINT FK_CIDADE_CLIENTE
FOREIGN KEY(ID_CIDADE) REFERENCES tb_cidade(IDCIDADE);

ALTER TABLE tb_cliente DROP COLUMN cidade;
ALTER TABLE tb_cliente DROP COLUMN estado;

ALTER TABLE tb_vaga MODIFY beneficios VARCHAR(150);


/**************************************************************/

/* ALTERAÇÕES A SEREM EFETUADAS */

CREATE TABLE tb_area_interesse (
    IDAREA INT PRIMARY KEY AUTO_INCREMENT,
    area_atuacao VARCHAR(20) UNIQUE NOT NULL,
    ID_CANDIDATO INT
);

ALTER TABLE tb_candidato ADD COLUMN CPF VARCHAR(11) UNIQUE NOT NULL; --alterar para VARCHAR(14)
ALTER TABLE tb_candidato ADD COLUMN endereco VARCHAR(100);
ALTER TABLE tb_candidato ADD COLUMN ID_CIDADE INT;
ALTER TABLE tb_candidato ADD COLUMN ID_AREA INT; --REMOVER
ALTER TABLE tb_candidato ADD COLUMN funcao VARCHAR(60);
/*campo curriculo em princípio armazena caminho para o arquivo. posso mudar futuramente para blob para armazenar o arquivo */
ALTER TABLE tb_candidato ADD COLUMN curriculo VARCHAR(100);
-- ALTER TABLE tb_candidato ADD COLUMN outra_cidade VARCHAR(60); REMOVER

-- ALTER TABLE tb_area_interesse DROP FOREIGN KEY FK_CANDIDATO_AREA;

ALTER TABLE tb_candidato ADD CONSTRAINT FK_CANDIDATO_AREA
FOREIGN KEY(ID_AREA) REFERENCES tb_area_interesse(IDAREA);

ALTER TABLE tb_candidato ADD CONSTRAINT FK_CANDIDATO_CIDADE
FOREIGN KEY(ID_CIDADE) REFERENCES tb_cidade(IDCIDADE);

ALTER TABLE tb_candidato MODIFY CPF VARCHAR(14);
ALTER TABLE tb_candidato MODIFY telefone VARCHAR(15);
ALTER TABLE tb_cliente MODIFY CNPJ VARCHAR(18);
ALTER TABLE tb_cliente MODIFY telefone VARCHAR(15);

/* FIM DAS ALTERAÇÕES */


/****************************************************************/

/*QUERYS DE TESTE */

UPDATE tb_vaga SET funcao='Contato Comercial', tipo='T', localTrab='Santo André', escolaridade='Ensino Médio Completo', horario='Seg. a Sex. 07:30 as 17:00', beneficios='Vale-Trasnporte, Vale-Refeição e Vale-Alimentação', descricao='Experiência em vendas na área de serviços, atendimento a clientes, Habilitação Cat B. Desejável conhecimentos na área de Recursos Humanos', ID_CLIENTE=1, fechamento='A', dataAlteracao=now(), destaque='', ID_USUARIO=1 , salario=15000.00 WHERE IDVAGA = 1;

INSERT INTO tb_cliente VALUES(null,"Andromeda Terceirização de Mão de Obra e Servicos Ltda","Rua Marcelino Dantas, 117","Vila Alzira","Santo Andre","SP","17237955000160","Jean","jeanmarcel@cygnusrh.com.br","1144383622");

INSERT INTO tb_vaga VALUES(null, 'Contato Comercial', 'T', 'Santo André', 'Ensino Médio Completo', 'Seg. a Sex. 07:30 as 17:00', 'Vale-Trasnporte, Vale-Refeição e Vale-Alimentação', 'Experiência em vendas na área de serviços, atendimento a clientes, Habilitação Cat B. Desejável conhecimentos na área de Recursos Humanos', 1, now(),'A', null);

SELECT V.funcao, C.nomecliente FROM tb_vaga AS V
INNER JOIN tb_cliente AS C
ON V.ID_CLIENTE = C.IDCLIENTE;

SELECT nomeCliente, count(*) FROM tb_cliente
INNER JOIN tb_vaga
ON ID_CLIENTE = IDCLIENTE
GROUP BY(ID_CLIENTE);

SELECT c.nomeCliente, count(v.ID_CLIENTE) FROM tb_cliente as c
LEFT JOIN tb_vaga as v
ON v.ID_CLIENTE = c.IDCLIENTE
WHERE v.fechamento LIKE '%%' 
GROUP BY(c.IDCLIENTE);

UPDATE tb_vaga SET destaque = 'S' WHERE IDVAGA=33;

SELECT funcao, tipo, c.nomeCidade as cidade, e.siglaEstado as estado, escolaridade, horario, beneficios, descricao, destaque FROM tb_vaga INNER JOIN tb_cidade AS c ON ID_CIDADE = c.IDCIDADE INNER JOIN tb_estado AS e ON c.ID_ESTADO = e.IDESTADO WHERE destaque='S' AND fechamento='A' ORDER BY dataCriacao DESC;


/*Select com soma de 30 dias na data de criação para cálculo do tempo de validade da vaga*/

SELECT funcao, tipo, c.nomeCidade as cidade, e.siglaEstado as estado, escolaridade, horario, beneficios, descricao, destaque, dataCriacao, 
DATE_ADD(dataCriacao, INTERVAL 30 DAY) as dataValidade FROM tb_vaga
INNER JOIN tb_cidade AS c ON ID_CIDADE = c.IDCIDADE 
INNER JOIN tb_estado AS e ON c.ID_ESTADO = e.IDESTADO 
WHERE fechamento='A' ORDER BY funcao;


/* ADD DATA */

INSERT INTO tb_user VALUES (null, 'jean', MD5('aczf0704'), 'Jean Marcel', null);

INSERT INTO tb_estado VALUES(null, 'Acre', 'AC');
INSERT INTO tb_estado VALUES(null, 'Amapá', 'AP');
INSERT INTO tb_estado VALUES(null, 'Amazonas', 'AM');
INSERT INTO tb_estado VALUES(null, 'Rondônia', 'RO');
INSERT INTO tb_estado VALUES(null, 'Roraima', 'RR');
INSERT INTO tb_estado VALUES(null, 'Pará', 'PA');
INSERT INTO tb_estado VALUES(null, 'Tocantins', 'TO');
INSERT INTO tb_estado VALUES(null, 'Goiás', 'GO');
INSERT INTO tb_estado VALUES(null, 'Distrito Federal', 'DF');
INSERT INTO tb_estado VALUES(null, 'Mato Grosso', 'MT');
INSERT INTO tb_estado VALUES(null, 'Mato Grosso do Sul', 'MS');
INSERT INTO tb_estado VALUES(null, 'Maranhão', 'MA');
INSERT INTO tb_estado VALUES(null, 'Piauí', 'PI');
INSERT INTO tb_estado VALUES(null, 'Ceará', 'CE');
INSERT INTO tb_estado VALUES(null, 'Rio Grande do Norte', 'RN');
INSERT INTO tb_estado VALUES(null, 'Pernambuco', 'PE');
INSERT INTO tb_estado VALUES(null, 'Alagoas', 'AL');
INSERT INTO tb_estado VALUES(null, 'Sergipe', 'SE');
INSERT INTO tb_estado VALUES(null, 'Bahia', 'BA');
INSERT INTO tb_estado VALUES(null, 'Paraíba', 'PB');
INSERT INTO tb_estado VALUES(null, 'Espírito Santo', 'ES');
INSERT INTO tb_estado VALUES(null, 'Minas Gerais', 'MG');
INSERT INTO tb_estado VALUES(null, 'Rio de Janeiro', 'RJ');
INSERT INTO tb_estado VALUES(null, 'São Paulo', 'SP');
INSERT INTO tb_estado VALUES(null, 'Paraná', 'PR');
INSERT INTO tb_estado VALUES(null, 'Santa Catarina', 'SC');
INSERT INTO tb_estado VALUES(null, 'Rio Grande do Sul', 'RS');

INSERT INTO tb_cidade VALUES(null, 'Mogi Mirim', 24);
INSERT INTO tb_cidade VALUES(null, 'Mogi Guaçu', 24);
INSERT INTO tb_cidade VALUES(null, 'Itapira', 24);
INSERT INTO tb_cidade VALUES(null, 'Santo André', 24);

INSERT INTO tb_cliente VALUES(null,"Andromeda Terceirização de Mão de Obra e Servicos Ltda","Rua Marcelino Dantas, 117","Vila Alzira","17.237.955/0001-60","Jean","jeanmarcel@cygnusrh.com.br","1144383622",4);

INSERT INTO tb_vaga VALUES(null, 'Contato Comercial', 'T', 'Santo André', 'Ensino Médio Completo', 'Seg. a Sex. 07:30 as 17:00', 'Vale-Trasnporte, Vale-Refeição e Vale-Alimentação', 'Experiência em vendas na área de serviços, atendimento a clientes, Habilitação Cat B. Desejável conhecimentos na área de Recursos Humanos', 1, now(),'A', null,null,null,1,4);