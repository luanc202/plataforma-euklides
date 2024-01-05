using UnityEngine;
using System.Collections;
using System.Collections.Generic;
using UnityEngine.SceneManagement;
using UnityEngine.UI;
using System;

public class gameController : MonoBehaviour {
    public static gameController instance { get; private set; }
    
    public static int level = 1;
    public int score;
    public Text textVidas;
    public Text textTempo;
    public Text textLevel;
    public float tempoRestante = 180;
    private static int index;
    private int[] mapalevel;
    public List<Expressao> expressaoListVerdadeiro = new List<Expressao>();
    public List<Expressao> expressaoListFalso = new List<Expressao>();
    public List<Vector2> posicoes = new List<Vector2>();
    private static System.Random rng = new System.Random();
    private SimplePlatformController SimplePlatformController;

  //  public GameObject go;
    [HideInInspector] public static int nBackgrounds = 1;
    
    // Use this for initialization
    void Start() {
        //score = 0;
        print("start");

        addPosicoes();

        desenharExpressoes();
    }

    private void Awake() {
        instance = this;
        //placar = GameObject.FindGameObjectWithTag("placar").GetComponent<Text>();
    }

    // Update is called once per frame
    void FixedUpdate () {
        tempoRestante -= Time.deltaTime;
        if(tempoRestante <= 0)
        {
            tempoRestante = 180;
        }
        UpdateTimer();

       // textVidas.text = "Vidas: " + vidas.ToString();
        textLevel.text = "Level " + level.ToString();
	}

    private void UpdateTimer()
    {
        textTempo.text = "Timer: " + Mathf.Round(tempoRestante).ToString();
    }

    private void addPosicoes()
    {
        posicoes.Add(new Vector2(-22.5f, -2.3f));
        posicoes.Add(new Vector2(-16.5f, -2.3f));
        posicoes.Add(new Vector2(-10.5f, -2.3f));
        posicoes.Add(new Vector2(-4.5f, -2.3f));
        posicoes.Add(new Vector2(1.5f, -2.3f));

        posicoes.Add(new Vector2(-22.5f, 1.05f));
        posicoes.Add(new Vector2(-16.5f, 1.05f));
        posicoes.Add(new Vector2(-10.5f, 1.05f));
        posicoes.Add(new Vector2(-4.5f, 1.05f));
        posicoes.Add(new Vector2(1.5f, 1.05f));

        posicoes.Add(new Vector2(-22.5f, 4.4f));
        posicoes.Add(new Vector2(-16.5f, 4.4f));
        posicoes.Add(new Vector2(-10.5f, 4.4f));
        posicoes.Add(new Vector2(-4.5f, 4.4f));
        posicoes.Add(new Vector2(1.5f, 4.4f));

        posicoes.Add(new Vector2(-22.5f, 7.75f));
        posicoes.Add(new Vector2(-16.5f, 7.75f));
        posicoes.Add(new Vector2(-10.5f, 7.75f));
        posicoes.Add(new Vector2(-4.5f, 7.75f));
        posicoes.Add(new Vector2(1.5f, 7.75f));

        posicoes.Add(new Vector2(-22.5f, 11.05f));
        posicoes.Add(new Vector2(-16.5f, 11.05f));
        posicoes.Add(new Vector2(-10.5f, 11.05f));
        posicoes.Add(new Vector2(-4.5f, 11.05f));
        posicoes.Add(new Vector2(1.5f, 11.05f));
    }

    private void desenharExpressoes()
    {

        print("Level: " + level);
        
        int getDataLevel = getData(level);

        print("passou no getdata "+getDataLevel);

        int j = 0;
        int k = 0;

        print("mapa: "+mapalevel.Length);
        expressaoListVerdadeiro = Shuffle(expressaoListVerdadeiro);
        expressaoListFalso = Shuffle(expressaoListFalso);
        for (int i = 0; i < mapalevel.Length; i++) 
        {
            GameObject go1 = new GameObject();
            SpriteRenderer rend = go1.AddComponent<SpriteRenderer>();
            rend.transform.position = posicoes[i];
           // print(level + " - " +posicoes[i].x);
            if(mapalevel[i] == 1)
            {
                Expressao exp = expressaoListVerdadeiro[j];
            //    print("Verdadeiro " +xp.nome+ " " + j);
             //   print("Expressoes/Level"+level+"/Verdadeiro/" + exp.nome);
                rend.sprite = Resources.Load<Sprite>("Expressoes/Level"+level+"/"+exp.nome);
                j++;
            } else if (mapalevel[i] == 0)
            {
                Expressao exp = expressaoListFalso[k];
             //   print("Falso " + exp.nome+ " " + k);
            //    print("Expressoes/Level"+level+"/Falso/" + exp.nome);
                rend.sprite = Resources.Load<Sprite>("Expressoes/Level"+level+"/"+exp.nome);
                k++;
            }
            
            Instantiate(go1, posicoes[i], Quaternion.identity);
        }
        
    }

    private int getData(int numLevel){
        switch (numLevel)
        {
            case 1:
                mapalevel = new int[25] {1, 1, 1, 0, 1, 
                    1, 0, 0, 1, 1, 
                    0, 0, 1, 0, 1, 
                    0, 1, 0, 0, 1, 
                    2, 0, 0, 1, 0};
                return addDadosLevel1();
                break;
            case 2:
                mapalevel = new int[25] {1, 0, 1, 0, 0,
                    0, 1, 0, 1, 0,
                    1, 0, 0, 0, 1,
                    1, 0, 0, 0, 1,
                    0, 1, 2, 1, 0};
                return addDadosLevel2();
                break;
            case 3:
                mapalevel = new int[25] {0, 1, 0, 0, 1,
                    0, 0, 1, 1, 0,
                    0, 1, 0, 0, 1,
                    0, 0, 1, 1, 1,
                    1, 2, 0, 1, 0};
                return addDadosLevel3();
                break;
            case 4:
                mapalevel = new int[25] {1, 0, 1, 0, 1,
                    0, 1, 0, 1, 1,
                    1, 0, 0, 0, 0,
                    1, 0, 1, 0, 1,
                    0, 1, 0, 1, 2};
                return addDadosLevel4();
                break;
            default:
                return 0;
                break;
        }
    }

    private int addDadosLevel1()
    {
        expressaoListVerdadeiro = new List<Expressao>();
        expressaoListFalso = new List<Expressao>();

        expressaoListVerdadeiro.Add(new Expressao(1, 1, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(2, 1, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(3, 1, "Verdadeiro"));
        expressaoListFalso.Add(new Expressao(4, 1, "Falso"));
        expressaoListFalso.Add(new Expressao(5, 1, "Falso"));

        expressaoListVerdadeiro.Add(new Expressao(6, 1, "Verdadeiro"));
        expressaoListFalso.Add(new Expressao(7, 1, "Falso"));
        expressaoListFalso.Add(new Expressao(8, 1, "Falso"));
        expressaoListVerdadeiro.Add(new Expressao(9, 1, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(10, 1, "Verdadeiro"));

        expressaoListFalso.Add(new Expressao(11, 1, "Falso"));
        expressaoListFalso.Add(new Expressao(12, 1, "Falso"));
        expressaoListVerdadeiro.Add(new Expressao(13, 1, "Verdadeiro"));
        expressaoListFalso.Add(new Expressao(14, 1, "Falso"));
        expressaoListVerdadeiro.Add(new Expressao(15, 1, "Verdadeiro"));

        expressaoListFalso.Add(new Expressao(16, 1, "Falso"));
        expressaoListVerdadeiro.Add(new Expressao(17, 1, "Verdadeiro"));
        expressaoListFalso.Add(new Expressao(18, 1, "Falso"));
        expressaoListFalso.Add(new Expressao(19, 1, "Falso"));
        expressaoListVerdadeiro.Add(new Expressao(20, 1, "Verdadeiro"));

        expressaoListFalso.Add(new Expressao(22, 1, "Falso"));
        expressaoListFalso.Add(new Expressao(23, 1, "Falso"));
        expressaoListVerdadeiro.Add(new Expressao(24, 1, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(25, 1, "Verdadeiro"));

        return 1;
    }

    private int addDadosLevel2()
    {
        expressaoListVerdadeiro = new List<Expressao>();
        expressaoListFalso = new List<Expressao>();

        expressaoListVerdadeiro.Add(new Expressao(1, 2, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(2, 2, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(3, 2, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(4, 2, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(5, 2, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(6, 2, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(7, 2, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(8, 2, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(9, 2, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(10, 2, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(11, 2, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(12, 2, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(13, 2, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(14, 2, "Verdadeiro"));


        expressaoListFalso.Add(new Expressao(15, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(16, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(17, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(18, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(19, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(20, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(21, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(22, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(23, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(24, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(25, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(26, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(27, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(28, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(29, 2, "Falso"));
        expressaoListFalso.Add(new Expressao(30, 2, "Falso"));

        print("terminou");
        return 2;
        
    }

    private int addDadosLevel3()
    {
        expressaoListVerdadeiro = new List<Expressao>();
        expressaoListFalso = new List<Expressao>();

        expressaoListVerdadeiro.Add(new Expressao(1, 3, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(2, 3, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(3, 3, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(4, 3, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(5, 3, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(6, 3, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(7, 3, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(8, 3, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(9, 3, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(10, 3, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(11, 3, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(12, 3, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(13, 3, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(14, 3, "Verdadeiro"));


        expressaoListFalso.Add(new Expressao(15, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(16, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(17, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(18, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(19, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(20, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(21, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(22, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(23, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(24, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(25, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(26, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(27, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(28, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(29, 3, "Falso"));
        expressaoListFalso.Add(new Expressao(30, 3, "Falso"));

        return 3;
        
    }

    private int addDadosLevel4()
    {
        expressaoListVerdadeiro = new List<Expressao>();
        expressaoListFalso = new List<Expressao>();

        expressaoListVerdadeiro.Add(new Expressao(1, 4, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(2, 4, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(3, 4, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(4, 4, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(5, 4, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(6, 4, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(7, 4, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(8, 4, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(9, 4, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(10, 4, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(11, 4, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(12, 4, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(13, 4, "Verdadeiro"));
        expressaoListVerdadeiro.Add(new Expressao(14, 4, "Verdadeiro"));


        expressaoListFalso.Add(new Expressao(15, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(16, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(17, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(18, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(19, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(20, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(21, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(22, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(23, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(24, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(25, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(26, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(27, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(28, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(29, 4, "Falso"));
        expressaoListFalso.Add(new Expressao(30, 4, "Falso"));
        
        return 4;
    }


    public List<Expressao> Shuffle(List<Expressao> list)  
    {  
        int n = list.Count;  
        while (n > 1) {  
            n--;  
            int k = rng.Next(n + 1);  
            Expressao value = list[k];  
            list[k] = list[n];  
            list[n] = value;  
        }  
        return list;
    }

}
