
CREATE DATABASE IF NOT EXISTS sistema;
USE sistema;


CREATE TABLE IF NOT EXISTS avaliacao (
  id int(11) NOT NULL,
  nome varchar(100) NOT NULL,
  estrelas int(11) NOT NULL,
  comentario text NOT NULL
);


CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    foto VARCHAR(255)
);
ALTER TABLE avaliacao ADD COLUMN user_id INT NOT NULL;

ALTER TABLE usuario
ADD COLUMN IF NOT EXISTS nivel ENUM('admin','usuario') NOT NULL DEFAULT 'usuario';

INSERT INTO usuario (nome, email, senha, nivel)
VALUES ('Admin Mary', 'admin@docesmary.com', '$2y$10$wTfV5Xq4xZzYdZlE0R/tD.6V6e.2nJj3h/xYkK5L6S7/a8O', 'admin');


CREATE TABLE IF NOT EXISTS servico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    foto VARCHAR(255)
);


CREATE TABLE IF NOT EXISTS contato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mensagem TEXT NOT NULL,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO servico (id, titulo, descricao, foto)
VALUES ('2', 'Bolo de Laranja', 'bolo de laranja molhadinho, com calda cítrica', 'https://cdn.casaeculinaria.com/wp-content/uploads/2024/07/04104618/Bolo-de-laranja-sem-gluten-e-sem-lactose.webp');
INSERT INTO servico (id, titulo, descricao, foto)
VALUES ('3', 'Bolo de coco', 'bolo de coco molhadinho e com sabor de infância', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRBCjQcTTwZor1EKm_S1uY_HyFTU05symfyA&s');
INSERT INTO servico (id, titulo, descricao, foto)
VALUES ('4', 'Bolo de chocolate', 'bolo de chocolate suculento e saboroso, com cobertura de chocolate ao leite', 'https://www.confeiteiradesucesso.com/wp-content/uploads/2019/02/bolodechocolatereceitaf.jpg');
INSERT INTO servico (id, titulo, descricao, foto)
VALUES ('5', 'Bolo Festivo', 'bolo de festa', 'https://www.sabornamesa.com.br/media/k2/items/cache/d4787dd5e343f0770fca324ff3790833_XL.jpg');
INSERT INTO servico (id, titulo, descricao, foto)
VALUES ('6', 'Brigadeiro', 'brigadeiro de chocolate ao leite, com 4 unidades ou avulso', 'https://i.ytimg.com/vi/LcaOVowHJqk/sddefault.jpg');
INSERT INTO servico (id, titulo, descricao, foto)
VALUES ('7', 'Cone Recheado', 'diversos sabores a escolher, entre eles: prestigio, ninho com nutela, chocolate, Paçoca, morango...', 'https://www.academiaassai.com.br/sites/default/files/shutterstock_1689234775.jpg');

INSERT INTO contato (id,nome,estrelas,comentario)
VALUES ('1','Gustavo','4','Bolos muitos gostosos!')
INSERT INTO contato (id,nome,estrelas,comentario)
VALUES ('2','Mary','5','Qualidade e atendimento impecáveis. Recomendo o brigadeiro gourmet para todos os eventos!')
INSERT INTO contato (id,nome,estrelas,comentario)
VALUES ('3','Maria','5','Os melhores doces que já provei! O bolo de chocolate é divino e o atendimento sempre atencioso.')


INSERT INTO usuario (nome,email,senha,nivel)
VALUES ('Maria vitoria','maria@gmail.com','$2y$10$RUEmrc.Rw6/dywXIN6Y0peqCfbscXFDNYUQxhKiQERYPkiK9oHRfG', 'usuario')
