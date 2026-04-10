package com.example.oda_kontrol_ve_takip_sistemi;

import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.example.oda_kontrol_ve_takip_sistemi.databinding.ActivityAnaMenuBinding;
import com.google.android.gms.tasks.OnFailureListener;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.firebase.firestore.DocumentReference;
import com.google.firebase.firestore.FirebaseFirestore;

import java.util.HashMap;
import java.util.Map;

public class AnaMenuActivity extends AppCompatActivity {

    public ActivityAnaMenuBinding binding;
    FirebaseFirestore db;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding=ActivityAnaMenuBinding.inflate(getLayoutInflater());
        EdgeToEdge.enable(this);
        setContentView(binding.getRoot());
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });
        db = FirebaseFirestore.getInstance();
    }
    public void veri_ekle (View view){
        // Create a new user with a first and last name
        Map<String, Object> data = new HashMap<>();
        data.put("Oda Numarası",binding.odaNumarasiTxtBox.getText().toString());
        data.put("Günler",binding.gNlerTxtBox.getText().toString());
        data.put("Saatler",binding.saatlerTxtBox.getText().toString());
        data.put("Klozet Temizliği",binding.klozetTxtBox.getText().toString());
        data.put("Lavabo Temizliği",binding.lavaboTxtBox.getText().toString());
        data.put("Musluk Temizliği",binding.muslukTxtBox.getText().toString());
        data.put("Ayna Temizliği",binding.aynaTxtBox.getText().toString());
        data.put("Kapı Kolu Temizliği",binding.kapKoluTxtBox.getText().toString());
        data.put("Zemin Temizliği",binding.zeminTxtBox.getText().toString());
        data.put("Çöp Torbasının Temizlği",binding.copTorbasiTxtBox.getText().toString());
        data.put("Oda İçi Temizliği",binding.odaIciTxtBox.getText().toString());
        data.put("Yatak Düzeni",binding.yatakTxtBox.getText().toString());
        data.put("Oda Tefrişatı Düzeni",binding.odaTerfrisatiTxtBox.getText().toString());

// Add a new document with a generated ID
        db.collection("Kayıtlar").document(binding.odaIciTxtBox.getText().toString())
                .set(data)
                .addOnSuccessListener(new OnSuccessListener<Void>() {
                    @Override
                    public void onSuccess(Void unused) {
                        Toast.makeText(AnaMenuActivity.this, "Veri ekleme işlemi başarılı...", Toast.LENGTH_SHORT).show();
                    }
                })
                .addOnFailureListener(new OnFailureListener() {
                    @Override
                    public void onFailure(@NonNull Exception e) {
                        Toast.makeText(AnaMenuActivity.this, "Veri ekleme işlemi başarısız!!", Toast.LENGTH_SHORT).show();
                    }
                });
    }
    public void veri_sil (View view){
        db.collection("Kayıtlar").document(binding.odaIciTxtBox.getText().toString())
                .delete()
                .addOnSuccessListener(new OnSuccessListener<Void>() {
                    @Override
                    public void onSuccess(Void unused) {
                        Toast.makeText(AnaMenuActivity.this, "Veri silme işlemi başarılı...", Toast.LENGTH_SHORT).show();
                    }
                })
                .addOnFailureListener(new OnFailureListener() {
                    @Override
                    public void onFailure(@NonNull Exception e) {
                        Toast.makeText(AnaMenuActivity.this, "Veri silme işlemi başarısız!!", Toast.LENGTH_SHORT).show();
                    }
                });
    }
    public void veri_güncelle (View view){
        Map<String, Object> data = new HashMap<>();
        data.put("Oda Numarası",binding.odaNumarasiTxtBox.getText().toString());
        data.put("Günler",binding.gNlerTxtBox.getText().toString());
        data.put("Saatler",binding.saatlerTxtBox.getText().toString());
        data.put("Klozet Temizliği",binding.klozetTxtBox.getText().toString());
        data.put("Lavabo Temizliği",binding.lavaboTxtBox.getText().toString());
        data.put("Musluk Temizliği",binding.muslukTxtBox.getText().toString());
        data.put("Ayna Temizliği",binding.aynaTxtBox.getText().toString());
        data.put("Kapı Kolu Temizliği",binding.kapKoluTxtBox.getText().toString());
        data.put("Zemin Temizliği",binding.zeminTxtBox.getText().toString());
        data.put("Çöp Torbasının Temizlği",binding.copTorbasiTxtBox.getText().toString());
        data.put("Oda İçi Temizliği",binding.odaIciTxtBox.getText().toString());
        data.put("Yatak Düzeni",binding.yatakTxtBox.getText().toString());
        data.put("Oda Tefrişatı Düzeni",binding.odaTerfrisatiTxtBox.getText().toString());
        db.collection("Kayıtlar").document(binding.odaIciTxtBox.getText().toString())
                .update(data)
                .addOnSuccessListener(new OnSuccessListener<Void>() {
                    @Override
                    public void onSuccess(Void unused) {
                        Toast.makeText(AnaMenuActivity.this, "Veri silme işlemi başarılı...", Toast.LENGTH_SHORT).show();
                    }
                })
                .addOnFailureListener(new OnFailureListener() {
                    @Override
                    public void onFailure(@NonNull Exception e) {
                        Toast.makeText(AnaMenuActivity.this, "Veri silme işlemi başarısız!!", Toast.LENGTH_SHORT).show();
                    }
                });
    }
}