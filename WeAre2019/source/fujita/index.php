<html>
<head>
<title>オルカアタック藤田龍介SourceCord</title>
<link rel="stylesheet" type="text/css" href="../coresys/default.css">
<link rel="stylesheet" href="../coresys/highlight/styles/monokai.css">
<script src="../coresys/highlight/highlight.pack.js"></script>
</head>
<body>
<h1>オルカアタックソースコード 藤田龍介</h1>
<h2>Orucase.cs</h2>
<pre><code class="cs">using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Orucase : MonoBehaviour {


    [SerializeField]
    private AudioClip[] audioClip;
    [SerializeField]
    private AudioSource[] sounds;

    void Start()
    {
        //sounds = GetComponents<AudioSource>();
    }

    private void OnCollisionEnter(Collision col)
    {
        switch (col.gameObject.tag)
        {
            case "Feed1":
                sounds[1].PlayOneShot(audioClip[1]);
                break;
            case "Seiuti":
                sounds[1].PlayOneShot(audioClip[2]);
                break;
            case "Unidori":
                sounds[1].PlayOneShot(audioClip[3]);
                break;
            case "Gomi":
                sounds[1].PlayOneShot(audioClip[4]);
                break;
            case "Gomi2":
                sounds[1].PlayOneShot(audioClip[5]);
                break;
        }
        sounds[0].PlayOneShot(audioClip[0]);
    }
}
</code></pre>
</br>
<h2>FeedGenerator.cs</h2>
<pre><code class="cs">using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System.Timers;

public class FeedGenerator : MonoBehaviour
{
    [SerializeField]
    private GameObject FeedPrefab;
    private float span = 2;
    [SerializeField]
    private float delta = 0;
    private float Speed = 2;
    [SerializeField]
    public int counter = 0;
    [SerializeField]
    AudioManager Audio;
    public Vector3 pos;
    private void Awake()
    {
        Audio = GetComponent<AudioManager>();
    }
    /// <summary>
    /// âa(ÉAÉVÉJ)ê∂ê¨ /ç∑Çµë÷Ç¶ëO
    /// </summary>
    private void Spawn()
    {
        this.delta += Time.deltaTime;
        //deltaÇ™spanÇÃéûä‘Çè„âÒÇ¡ÇΩÇ∆Ç´
        if (this.delta > this.span)
        {
            this.delta = 0;
            GameObject go = Instantiate(FeedPrefab) as GameObject;
            go.name = go.name.Replace("(Clone)", "");
            //îÕàÕÇ≈ÉâÉìÉ_ÉÄê∂ê¨
            float px = Random.Range(-4, 4);
            float py = Random.Range(12, 12);
            //ïΩçsà⁄ìÆ
            go.transform.position = new Vector3(px, py, 16.1f);
            Vector3 pos = transform.position;
            transform.position = pos;
            counter++;
        }
    }
    private void Start()
    {
        //ç≈èâÇÃ8ëÃåƒÇ—èoÇµ(ÉJÉEÉìÉgÇ≥ÇÍÇ»Ç¢ÇÊÇ§Ç…ÇµÇƒÇ¢ÇÈ)
        for(int i = 0; i < 3; i++)
        {
            delta = span + 1;
            Spawn();
            counter = 0;
        }
    }
    /// <summary>
    ///à»â∫í≤êÆíÜ 
    /// </summary>
    public void Revival()
    {
        //0.5ïbå„Ç…âaê∂ê¨
        //Invoke("F",0.5f);
    }
    private void F()
    {
        counter--;
        delta = span + 1;
        Spawn();
    }
    void Update()
    {
        Spawn();
        //âaÇ™0Ç…Ç»Ç¡ÇΩÇÁî’ñ ÉäÉZÉbÉg(í≤êÆíÜ)
        if(counter == -8)
        {
            Start();
        }
    }
}
</code></pre>
</br>
<h2>maware_asika.cs</h2>
<pre><code class="cs">using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class maware_asika : MonoBehaviour {
    Vector3 reverse;
    [SerializeField]
    private float Speed = 2;


    // Use this for initialization
    void Start () {
}

// Update is called once per frame
void Update () {
        Movement();
        reverse.z = 0;

}
    //ÉAÉVÉJÇÃìÆÇ´ç∑Çµë÷Ç¶ëO
    private void Movement()
    {

        transform.Translate(Speed * Time.deltaTime, 0, 0);

    }
    private void OnCollisionEnter(Collision col)
    {

        Debug.Log(col.gameObject.name);
    
        if (col.gameObject.tag == "wall")// || col.gameObject.tag == "wall2")
        {

            FripX();
        }
    }
    public void FripX()
    {
        reverse = transform.localScale;
        reverse.x *= -1;
        transform.localScale = reverse;
        transform.Translate(Speed * Time.deltaTime, 0, 0);
        Speed = -1 * Speed;
    }
}
</code></pre></br>
<h3>
<a target="_blank" href="https://github.com/KURO-Games/OrcaAttack" color="skyblue">Github</a>
</h3>
</body>
</html>
