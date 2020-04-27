using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;
using UnityEngine.Networking;
using System;

public class GameController : MonoBehaviour {

    public Text textoPergunta;
    public Text textoPontos;
    public Text textoTimer;
    public Text highScoreText;
    public Text pulosButtonText;
    public Text segundasButtonText;
    public Text cortarButtonText;

    public Button pularButton;
    public Button segundaChanceButton;
    public Button cortarButton;

    public SimpleObjectPool answerButtonObjectPool;
    public Transform answerButtonParent;
    public GameObject painelDePerguntas;
    public GameObject painelFimRodada;

    private DataController dataController;
    private RoundData rodadaAtual;
    private QuestionData[] questionPool;
    private QuestionData questionData;

    private bool rodadaAtiva;
    private float tempoRestante;
    private int questionIndex;
    private int playerScore;
    private bool segunda = false;
    private int numPulos = 3;
    private int numSegundas = 2;
    private int numCortarDuas = 1;
    private float tempoTotal = 0;

    private string url_parametros;
    private string[] parametros_str;
    private int[] parametros;

    List<int> usedValues = new List<int>();

    private List<GameObject> answerButtonGameObjects = new List<GameObject>();

    // Start is called before the first frame update
    void Start() 
    {
        int pm = Application.absoluteURL.IndexOf("?");
         if (pm != -1) {
            url_parametros = Application.absoluteURL.Split("?"[0])[1];
        }
        parametros_str = url_parametros.Split(',');
        parametros = new int[parametros_str.Length];
        for(int i = 0; i < parametros.Length; i++){
            parametros[i] = Int32.Parse(parametros_str[i]);
        }

    	//criar uma lista com perguntas
        dataController = FindObjectOfType<DataController>();
        rodadaAtual = dataController.GetCurrentRoundData();
        questionPool = rodadaAtual.perguntas;
        tempoRestante = rodadaAtual.limiteDeTempo;

        playerScore = 0;
        questionIndex = 0;
        ShowQuestion();
        rodadaAtiva = true;
    }

    // Update is called once per frame
    void Update() {
        if (rodadaAtiva)
        {
            tempoRestante -= Time.deltaTime;
            tempoTotal += Time.deltaTime;
            UpdateTimer();
            if(tempoRestante <= 0)
            {
                EndRound();
            }
        }
    }

    private void UpdateTimer()
    {
        textoTimer.text = "Timer: " + Mathf.Round(tempoRestante).ToString();
    }

    private void ShowQuestion()
    {
        RemoveAnswerButtons();
        if (numPulos > 0)
        {
        	pularButton.interactable = true;
        }
        if (numSegundas > 0)
        {
        	segundaChanceButton.interactable = true;
        }
        if (numCortarDuas > 0)
        {
        	cortarButton.interactable = true;
        }
        
        int random = UnityEngine.Random.Range(0, questionPool.Length);
        while (usedValues.Contains(random))
        {
            random = UnityEngine.Random.Range(0, questionPool.Length);
        }

        questionData = questionPool[random];
        usedValues.Add(random);
        textoPergunta.text = questionData.textoDaPergunta;

        for (int i = 0; i < questionData.respostas.Length; i++)
        {
            GameObject answerButtongameObject = answerButtonObjectPool.GetObject();
            answerButtongameObject.transform.SetParent(answerButtonParent);
            answerButtonGameObjects.Add(answerButtongameObject);
            AnswerButton answerButton = answerButtongameObject.GetComponent<AnswerButton>();
            answerButton.Setup(questionData.respostas[i]);
        }

    }

    private void RemoveAnswerButtons()
    {
        while(answerButtonGameObjects.Count > 0)
        {
            answerButtonObjectPool.ReturnObject(answerButtonGameObjects[0]);
            answerButtonGameObjects.RemoveAt(0);
        }
    }

    public void AnswerButtonClicked(bool estaCorreto, string textoResp)
    {
        if (estaCorreto)
        {
            playerScore += rodadaAtual.pontosPorAcerto;
            textoPontos.text = "Score: " + playerScore.ToString();

            if(questionPool.Length > questionIndex + 1)
	        {
	            questionIndex++;
	            ShowQuestion();
	        }
	        else
	        {
	            EndRound();
	        }

        } else if (segunda)
        {
        	int itemExcluido = 0;
            for (int i = 0; i < answerButtonGameObjects.Count; i++)
            {
                answerButtonObjectPool.ReturnObject(answerButtonGameObjects[i]);
                AnswerButton answerButton = answerButtonGameObjects[i].GetComponent<AnswerButton>();
                if (answerButton.getData().textoResposta.Equals(textoResp))
                {
                    itemExcluido = i;
                    RemoveAnswerButtons();
                }
            }
            for (int i = 0; i < questionData.respostas.Length; i++)
	        {
	        	if (i != itemExcluido) {
	        		GameObject answerButtongameObject = answerButtonObjectPool.GetObject();
		            answerButtongameObject.transform.SetParent(answerButtonParent);
		            answerButtonGameObjects.Add(answerButtongameObject);
		            AnswerButton answerButton = answerButtongameObject.GetComponent<AnswerButton>();
		            answerButton.Setup(questionData.respostas[i]);
	        	} 
	        }
            segunda = false;
        } else {
        	if(questionPool.Length > questionIndex + 1)
	        {
	            questionIndex++;
	            ShowQuestion();
	        }
	        else
	        {
	            EndRound();
	        }
        }

    }

    public void EndRound()
    {
        StartCoroutine(Registro());

        rodadaAtiva = false;

        dataController.EnviarNovoHighScore(playerScore);
        highScoreText.text = "Score: " + playerScore;

        painelDePerguntas.SetActive(false);
        painelFimRodada.SetActive(true);
    }

    IEnumerator Registro(){
        WWWForm form = new WWWForm();
        form.AddField("cod_aluno", parametros[0]);
        form.AddField("cod_sala", parametros[1]);
        form.AddField("cod_jogo", 1);
        form.AddField("tempo_gasto", Mathf.RoundToInt(tempoTotal));
        form.AddField("num_dicas", 6 - numPulos - numCortarDuas - numSegundas);
        form.AddField("num_acertos", (playerScore/10));
        form.AddField("num_erros", questionPool.Length - (playerScore/10));
        form.AddField("level", rodadaAtual.nomeDoTema);
        WWW www = new WWW("http://localhost/euklides/plataforma-euklides/registra_jogada.php", form);
        yield return www;
        highScoreText.text = www.text;
        if(www.text == "0"){
            Debug.Log("Jogada cadastrada");
        } else{
            Debug.Log("Erro #" + www.text);
        }
    }

    public void ReturnToMenu()
    {
        SceneManager.LoadScene("Menu");
    }

    public void pularPergunta()
    {
        if (numPulos > 0)
        {
            if (questionPool.Length > questionIndex + 1)
            {
                questionIndex++;
                ShowQuestion();
            }
            else
            {
                EndRound();
            }
            numPulos -= 1;
            pulosButtonText.text = "Pular pergunta (" + numPulos + ")";
        } else 
        {
        	pularButton.interactable = false;
        }
    }

    public void segundaChance()
    {
        if (numSegundas > 0)
        {
        	segundaChanceButton.interactable = false;
            segunda = true;
            numSegundas -= 1;
            segundasButtonText.text = "Segunda chance (" + numSegundas + ")";
        } else 
        {
        	segundaChanceButton.interactable = false;
        }
       
    }

    public void cortarDuasRespostas()
    {
    	if (numCortarDuas > 0) 
    	{
    		RemoveAnswerButtons();
    		cortarButton.interactable = false;
    		int[] respExcluidas = new int[3];
    		int j = 0;
    		int respostaCerta = 0;
    		for (int i = 0; i < questionData.respostas.Length; i++)
	        {
	        	if (!questionData.respostas[i].estaCorreta) 
	        	{
	        		respExcluidas[j] = i;
	        		j++;
	        	} else {
	        		respostaCerta = i;
	        	}
	        }
	        int random = UnityEngine.Random.Range(0, respExcluidas.Length);

	        if (respExcluidas[random] > respostaCerta)
	        {
	        	createButton(respostaCerta);
	        	createButton(respExcluidas[random]);	
	        } else 
	        {
	        	createButton(respExcluidas[random]);
	        	createButton(respostaCerta);
	        }
	        numCortarDuas -= 1;
	        cortarButtonText.text = "Cortar duas (" + numCortarDuas + ")";
    	} else 
    	{
    		cortarButton.interactable = false;
    	}
    }

    private void createButton(int index)
    {
    	GameObject answerButtongameObject = answerButtonObjectPool.GetObject();
		answerButtongameObject.transform.SetParent(answerButtonParent);
		answerButtonGameObjects.Add(answerButtongameObject);
		AnswerButton answerButton = answerButtongameObject.GetComponent<AnswerButton>();
		answerButton.Setup(questionData.respostas[index]);
    }

}
