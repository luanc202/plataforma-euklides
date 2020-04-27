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
            
        string dataAsJson = "{\"todasAsRodadas\":[{\"nomeDoTema\":\"Tema 1\",\"limiteDeTempo\":30,\"pontosPorAcerto\":10,\"perguntas\":[{\"textoDaPergunta\":\"Pergunta 1-teste\",\"respostas\":[{\"textoResposta\":\"Opção a\",\"estaCorreta\":false},{\"textoResposta\":\"Opção b\",\"estaCorreta\":false},{\"textoResposta\":\"Opção c\",\"estaCorreta\":true},{\"textoResposta\":\"Opção d\",\"estaCorreta\":false}]},{\"textoDaPergunta\":\"Pergunta 2\",\"respostas\":[{\"textoResposta\":\"Opção a\",\"estaCorreta\":false},{\"textoResposta\":\"Opção b\",\"estaCorreta\":true},{\"textoResposta\":\"Opção c\",\"estaCorreta\":false},{\"textoResposta\":\"Opção d\",\"estaCorreta\":true}]}]},{\"nomeDoTema\":\"Tema 2\",\"limiteDeTempo\":0,\"pontosPorAcerto\":0,\"perguntas\":[]}]}";
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
