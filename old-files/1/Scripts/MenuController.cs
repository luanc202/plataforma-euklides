using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;

public class MenuController : MonoBehaviour {

	private DataController data;
    private RoundData round;
    // Start is called before the first frame update
    void Start() {
        data = FindObjectOfType<DataController>();
       // data.SetRoundData(0);
       // round = data.GetCurrentRoundData();
       // primeiroTema.Text = round.nomeDoTema;

        //data.SetRoundData(1);
       // round = data.GetCurrentRoundData();
        //segundoTema.Text = round.nomeDoTema;

       // data.SetRoundData(2);
       // round = data.GetCurrentRoundData();
      //  terceiroTema.Text = round.nomeDoTema;
    }

    public void StartGame(int round) {
    	//define qual é a rodada (fácil, intermediário...)
        print("Começou: "+round);
    	data.SetRoundData(round);
    	SceneManager.LoadScene("Game");
    }

}
