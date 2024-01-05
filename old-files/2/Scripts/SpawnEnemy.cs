using UnityEngine;
using System.Collections;

public class SpawnEnemy : MonoBehaviour {

    public Transform[] enemySpawns;
    public GameObject enemy;

    // Use this for initialization
    void Start() {
        Spawn();
    }

    void Spawn() {
        for (int i = 0; i < enemySpawns.Length; i++) {
            int enemyFlip = Random.Range(0, 2);
            if (enemyFlip > 0)
                Instantiate(enemy, enemySpawns[i].position, Quaternion.identity);
        }
    }
}
