using UnityEngine;
using System.Collections;

public class SpawnManager : MonoBehaviour
{
    public GameObject player;
    public GameObject platform;
    public float horizontalMin = 7.5f;
    public float horizontalMax = 14f;
    public float verticalMin = -6f;
    public float verticalMax = 6;
    static public float totalHorizontal = 0;
    public SpriteRenderer background;

    private Vector2 originPosition;
    void Start()
    {
        originPosition = transform.position;
        totalHorizontal = 0;
    }

    void Awake()
    {
        originPosition = transform.position;
        totalHorizontal = 0;

    }

    void Update()
    {
        if (totalHorizontal <= player.transform.position.x)
        {
            Vector2 randomSize = new Vector2(Random.Range(horizontalMin, horizontalMax), Random.Range(verticalMin, verticalMax));
            Vector2 randomPosition = originPosition + randomSize;
            Instantiate(platform, randomPosition, Quaternion.identity);
            originPosition = randomPosition;
            totalHorizontal += randomSize.x;
        }

        background = GameObject.FindGameObjectWithTag("Background").GetComponent<SpriteRenderer>();
        var renderer = background.GetComponent<Renderer>();
        float width = renderer.bounds.size.x;

        if (width * gameController.nBackgrounds < player.transform.position.x + 100) {
            print(width * gameController.nBackgrounds);
            Vector3 theScale = background.transform.localScale;
            theScale.x = width * gameController.nBackgrounds;
            theScale.y = background.transform.position.y;
            transform.localScale = theScale;

            Instantiate(background, theScale, Quaternion.identity);

            gameController.nBackgrounds++;
        }
    }

    public static float GetTotalHorizontal()
    {
        return totalHorizontal;
    }
}
