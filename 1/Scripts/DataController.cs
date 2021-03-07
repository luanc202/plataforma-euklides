using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;
using System.IO;
using System;

public class DataController : MonoBehaviour {

	private RoundData[] todasAsRodadas;
	private int rodadaIndex;
	private int playerHighScore;

    //private string gameDataFileName = "data.json";

    // Start is called before the first frame update
    void Start() {
        DontDestroyOnLoad(gameObject);

        LoadGameData();
        LoadPlayerProgress();

        SceneManager.LoadScene("Menu");
    }

    // Update is called once per frame
    void Update() {
        
    }

    public void SetRoundData(int round) {
    	rodadaIndex = round;
    }

    public RoundData GetCurrentRoundData() {
    	return todasAsRodadas[rodadaIndex];
    }

    private void LoadGameData()
    {
        //string filePath = Path.Combine(Application.streamingAssetsPath, gameDataFileName);

        //if (File.Exists(filePath))
        //{
            
        string dataAsJson = "{\"todasAsRodadas\":"+
            "[{\"nomeDoTema\":\"Soft e Hard\",\"limiteDeTempo\":120,\"pontosPorAcerto\":10,\"perguntas\":["+
                //1
            "{\"textoDaPergunta\":\"O que é Hardware?\",\"respostas\":[{\"textoResposta\":\"A parte lógica do computador.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"A parte física do computador.\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"A parte burocrática do computador.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"As pessoas que usam o computador.\",\"estaCorreta\":false}]}," +
                //2
            "{\"textoDaPergunta\":\"O que é Software?\",\"respostas\":[{\"textoResposta\":\"A parte lógica do computador.\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"A parte física do computador.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"A parte burocrática do computador.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"As pessoas que usam o computador.\",\"estaCorreta\":false}]}," +
                //3
            "{\"textoDaPergunta\":\"São exemplos de Hardware:\",\"respostas\":[{\"textoResposta\":\"Power Point, Gabinete e Monitor.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Windows, Linux e Word.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Placa-mãe, Memória e Bateria.\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"Bateria, Excel e Placa-mãe.\",\"estaCorreta\":false}]}," +
                //4
            "{\"textoDaPergunta\":\"São exemplos de Software:\",\"respostas\":[{\"textoResposta\":\"Calculadora, Ábaco e Tabuladora.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Windows, Ábaco e Calculadora.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Linux, Memória e Power Point.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Windows, Linux e Calculadora.\",\"estaCorreta\":true}]}," +
                //5
            "{\"textoDaPergunta\":\"Os Software são divididos em:\",\"respostas\":[{\"textoResposta\":\"Básicos, Aplicativos e Utilitários.\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"Básicos, Aplicativos e Tabuladores.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Físicos, Aplicativos e Utilitários.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Tabuladores, Aplicativos e Físicos.\",\"estaCorreta\":false}]}," +
                //6
            "{\"textoDaPergunta\":\"São exemplos de Sistema Operacional:\",\"respostas\":[{\"textoResposta\":\"Word e Windows.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Processador e Hardware.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Linux e Windows.\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"Software e Hardware.\",\"estaCorreta\":false}]}," +
                //7
            "{\"textoDaPergunta\":\"Podemos definir INFORMÁTICA, como:\",\"respostas\":[{\"textoResposta\":\"A ciência que trata logicamente os dados.\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"O Hardware que trata logicamente os dados.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"O Programa de Computador.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"As peças do computador.\",\"estaCorreta\":false}]}," +
                //8
            "{\"textoDaPergunta\":\"Qual dos periféricos abaixo é um periférico de entrada de dados?\",\"respostas\":[{\"textoResposta\":\"Datashow\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Caixas de som\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Impressora\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Teclado\",\"estaCorreta\":true}]}," +
                //9
            "{\"textoDaPergunta\":\"São sistemas operacionais:\",\"respostas\":[{\"textoResposta\":\"Asus, AMD e Intel.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Word, Excel e Powerpoint.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Windows 8, Android e IOS.\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"Mozila Firefox, Internet Explore e Google Chrome.\",\"estaCorreta\":false}]}," +
                //10
            "{\"textoDaPergunta\":\"Qual dos periféricos abaixo é um periférico de saída de dados?\",\"respostas\":[{\"textoResposta\":\"Monitor\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"Teclado\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Mouse\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Scanner\",\"estaCorreta\":false}]}" +

            "]}," +

            "{\"nomeDoTema\":\"Historico\",\"limiteDeTempo\":120,\"pontosPorAcerto\":15,\"perguntas\":["+
                //1
            "{\"textoDaPergunta\":\"Qual destas respostas definem a primeira geração de computadores?\",\"respostas\":[{\"textoResposta\":\"Super rápidas.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Aparelhos enormes que funcionavam com tubos de vácuo.\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"Tinham grande capacidade de armazenamento.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Funcionavam com nano chips.\",\"estaCorreta\":false}]}," +
                //2
            "{\"textoDaPergunta\":\"Em 1951 os computadores eram para o uso:\",\"respostas\":[{\"textoResposta\":\"Comercial.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Pessoal.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Só para instituições do governo e algumas empresas.\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"Só para pessoas com posses.\",\"estaCorreta\":false}]}," +
                //3
            "{\"textoDaPergunta\":\"O que foi mais relevante na segunda geração dos computadores?\",\"respostas\":[{\"textoResposta\":\"O uso de tubos de vácuo.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Uso de nano chips.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Uso de transístores.\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"Uso de memórias.\",\"estaCorreta\":false}]}," +
                //4
            "{\"textoDaPergunta\":\"Pelo que se caracteriza a terceira geração de computadores?\",\"respostas\":[{\"textoResposta\":\"Pelo uso de nano chips.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Pelo uso de circuitos integrados.\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"Pelo uso de leds.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Pelo uso de cabos.\",\"estaCorreta\":false}]}," +
                //5
            "{\"textoDaPergunta\":\"O uso do Microprocessador aplica-se a partir da:\",\"respostas\":[{\"textoResposta\":\"3ra geração de computadores.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"4ta geração de computadores.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"2da geração de computadores.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"5ta geração de computadores.\",\"estaCorreta\":true}]}," +
                //6
            "{\"textoDaPergunta\":\"O que é multi-processamento?\",\"respostas\":[{\"textoResposta\":\"É a capacidade de realizar milhões de cálculos aritméticos de maneira simultânea num só segundo.\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"É a capacidade de adicionar e subtrair rápido.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"É o uso do CPU vez à vez.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"N.D.A.\",\"estaCorreta\":false}]}," +
                //7
            "{\"textoDaPergunta\":\"Qual o nome do primeiro computador?\",\"respostas\":[{\"textoResposta\":\"UNIVAC\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"EDVAC\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"ENIAC\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"XEROX Alto\",\"estaCorreta\":false}]}," +
                //8
            "{\"textoDaPergunta\":\"Podemos afirmar que a função da C.P.U. é:\",\"respostas\":[{\"textoResposta\":\"Evitar a entrada de vírus no computador.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"É responsável pelo processamento, controle e gerenciamento das informações. \",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"É responsável pelo armazenamento das informações gravadas no monitor.\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"N.D.A.\",\"estaCorreta\":false}]}," +
                //9
            "{\"textoDaPergunta\":\"O que acontece com o conteúdo da memória Ram quando o computador é desligado?\",\"respostas\":[{\"textoResposta\":\"Permanece armazenado \",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"É parcialmente apagado \",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"É totalmente perdido\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"É gravado \",\"estaCorreta\":false}]}," +
                //10
            "{\"textoDaPergunta\":\"Qual o elemento do hardware que distribui as tarefas a todos os componentes do sistema?\",\"respostas\":[{\"textoResposta\":\"Memória RAM\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Microprocessador \",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"Teclado \",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Memória ROM \",\"estaCorreta\":false}]}," +
            	//11
            "{\"textoDaPergunta\":\"Conhecido como cérebro do computador: \",\"respostas\":[{\"textoResposta\":\"Winchester \",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Microprocessador \",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"Memória ROM \",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Memória Cache\",\"estaCorreta\":false}]}," +
            	//12
            "{\"textoDaPergunta\":\"Quanto à memória RAM, qual das alternativas faz uma afirmação verdadeira?\",\"respostas\":[{\"textoResposta\":\"É uma memória de baixo desempenho, em relação ao HardDisk. \",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"É um tipo de memória volátil. \",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"Pode-se expandir com o uso de CD-ROM. \",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"Seu método de gravação se dá por meio magnético.\",\"estaCorreta\":false}]}" +

            "]}," +

            "{\"nomeDoTema\":\"Python\",\"limiteDeTempo\":120,\"pontosPorAcerto\":20,\"perguntas\":["+
                //1
            "{\"textoDaPergunta\":\"Qual dos métodos abaixo usamos para receber algum dado do usuário?\",\"respostas\":[{\"textoResposta\":\"print()\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"prompt()\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"scanf() \",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"input()\",\"estaCorreta\":true}]}," +
                //2
            "{\"textoDaPergunta\":\"Qual a forma correta de declarar uma função?\",\"respostas\":[{\"textoResposta\":\"function soma(A, B):\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"def soma(A, B):\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"func soma(A, B):\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"soma(A, B){ }\",\"estaCorreta\":false}]}," +
                //3
            "{\"textoDaPergunta\":\"Qual método para trabalhar com Strings, deixa todos os caracteres maiúsculos?\",\"respostas\":[{\"textoResposta\":\"upper()\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"lower()\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"isnumeric()\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"swapcase()\",\"estaCorreta\":false}]}," +
                //4
            "{\"textoDaPergunta\":\"Qual a forma correta para importar o método pi módulo math em seu script?\",\"respostas\":[{\"textoResposta\":\"import math from pi\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"from math import pi\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"import pi\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"from pi\",\"estaCorreta\":false}]}," +
                //5
            "{\"textoDaPergunta\":\"Como criar uma lista com números de 1 a 5?\",\"respostas\":[{\"textoResposta\":\"lista = num(1, 5)\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"lista = (1, 2, 3, 4, 5)\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"lista = 1, 2, 3, 4, 5\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"lista = [1, 2, 3, 4, 5]\",\"estaCorreta\":true}]}," +
                //6
            "{\"textoDaPergunta\":\"Qual dos nomes abaixo não pode ser um nome de variável?\",\"respostas\":[{\"textoResposta\":\"Nomes123\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"7dedos\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"_texto\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"a2b3\",\"estaCorreta\":false}]}," +
                //7
            "{\"textoDaPergunta\":\"Qual das alternativas apresenta somente estruturas de repetição?\",\"respostas\":[{\"textoResposta\":\"for, case\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"while, for\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"if, else\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"while, if\",\"estaCorreta\":false}]}," +
                //8
            "{\"textoDaPergunta\":\"Qual das alternativas apresenta somente estruturas de condicionais?\",\"respostas\":[{\"textoResposta\":\"if, else\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"while, for\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"for, else\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"while, if\",\"estaCorreta\":false}]}," +
                //9
            "{\"textoDaPergunta\":\"Tendo em vista as regras de precedência da linguagem Python, o que será impresso no código a seguir: x=(1+1)**(5-2) print (x)\",\"respostas\":[{\"textoResposta\":\"1\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"3\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"6\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"8\",\"estaCorreta\":true}]}," +
                //10
            "{\"textoDaPergunta\":\"Tendo em vista as regras de precedência da linguagem Python, o que será impresso no código a seguir: x=7*3**2%4 print (x)\",\"respostas\":[{\"textoResposta\":\"1\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"3\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"7\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"15,75\",\"estaCorreta\":false}]}," +
                //11
            "{\"textoDaPergunta\":\"Qual operador lógico utilizado para verificar de dois valores são diferentes?\",\"respostas\":[{\"textoResposta\":\"==\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"!!\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"!=\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\">=\",\"estaCorreta\":false}]}," +
            	//12
            "{\"textoDaPergunta\":\"Tendo em vista as regras de precedência da linguagem Python, o que será impresso no código a seguir: x=1+2**3 print (x)\",\"respostas\":[{\"textoResposta\":\"5\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"7\",\"estaCorreta\":false}," +
            "{\"textoResposta\":\"9\",\"estaCorreta\":true}," +
            "{\"textoResposta\":\"27\",\"estaCorreta\":false}]}" +

            "]}]}";

       // print(dataAsJson);
        GameData loadedData = JsonUtility.FromJson<GameData>(dataAsJson);
        todasAsRodadas = loadedData.todasAsRodadas;

        //}
       // else
       // {
        //    Debug.LogError("Não foi possível carregas dados");
        //}
    }

    public void EnviarNovoHighScore(int newScore)
    {
        if (newScore > playerHighScore)
        {
            playerHighScore = newScore;
            SavePlayerProgress();
        }
    }

    public int GetHighScore()
    {
        return playerHighScore;
    }

    private void LoadPlayerProgress()
    {
        if (PlayerPrefs.HasKey("highScore"))
        {
            playerHighScore = PlayerPrefs.GetInt("highScore");
        }
    }

    private void SavePlayerProgress()
    {
        PlayerPrefs.SetInt("highScore", playerHighScore);
    }

   
}
